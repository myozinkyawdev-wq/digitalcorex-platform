<?php

namespace App\Console\Commands\Seeders\Shop;

use App\Models\VariantUnit;
use Illuminate\Console\Command;

class VariantUnitSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:variant-units';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To insert product variant units seeder.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (config('variant-units') as $unit) {
            $variantUnit = VariantUnit::updateOrCreate([
                'name' => $unit['name'],
            ], $unit);

            $variantUnit->children()->createMany($unit['children']);
        }

        $this->info('Variant units successfully inserted...');
    }
}
