<?php

namespace App\Console\Commands\Seeders\Shop;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantUnitValue;
use App\Models\VariantUnit;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class ProductSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To insert products seeder.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = config('products');

        foreach ($products as $productData) {
            // Resolve category_id from category_code
            $category = Category::query()
                ->where('code', $productData['category_code'])
                ->first();

            if (!$category) {
                $this->warn("Category not found for code: {$productData['category_code']}. Skipping {$productData['slug']}.");
                continue;
            }

            // Upsert product
            $productPayload = Arr::except($productData, ['category_code', 'variants']);
            $productPayload['category_id'] = $category->id;

            $product = Product::query()->updateOrCreate(
                ['slug' => $productPayload['slug']],
                $productPayload
            );

            // Upsert variants + pivot values
            foreach (($productData['variants'] ?? []) as $variantData) {
                // IMPORTANT: remove any dangling 'product_id' item from config; we set it here
                $unitValues = $variantData['product_variant_unit_values'] ?? [];

                $variantPayload = Arr::except($variantData, ['product_variant_unit_values']);
                $variantPayload['product_id'] = $product->getId();

                $productVariant = ProductVariant::query()->updateOrCreate(
                    [
                        'product_id' => $product->getId(),
                        'name'       => $variantPayload['name'], // adjust uniqueness rule if needed
                    ],
                    $variantPayload
                );

                // Clear existing pivot rows for this variant and re-insert (safe + simple)
                ProductVariantUnitValue::query()
                    ->where('product_variant_id', $productVariant->getId())
                    ->delete();

                foreach ($unitValues as $uv) {
                    $unitType = $uv['unit_type'] ?? null;
                    $value    = $uv['value'] ?? null;

                    if ($unitType === null) {
                        continue;
                    }

                    // Find VariantUnit by type
                    $variantUnit = VariantUnit::query()
                        ->with('parent')
                        ->where('type', $unitType)
                        ->first();

                    if (!$variantUnit) {
                        $this->warn("VariantUnit not found for type: {$unitType}. Skipping pivot row.");
                        continue;
                    }
                    
                    if (!$variantUnit->parent) {
                        $this->warn("VariantUnit parent not found for type: {$unitType}. Skipping pivot row.");
                        continue;
                    }

                    $productVariant->productVariantUnitValues()->create([
                        'variant_unit_type_id'    => $variantUnit->parent->getId(),
                        'variant_unit_id'    => $variantUnit->getId(),
                        'value'              => (string) $value,
                    ]);
                }
            }
        }

        $this->info('Products successfully inserted...');
    }
}
