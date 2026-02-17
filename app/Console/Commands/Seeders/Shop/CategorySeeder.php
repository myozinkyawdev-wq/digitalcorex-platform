<?php

namespace App\Console\Commands\Seeders\Shop;

use App\Models\Category;
use Illuminate\Console\Command;

class CategorySeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To insert categories seeder.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (config('categories') as $categoryData) {
            Category::query()->updateOrCreate([
                'name' => $categoryData['name'],
            ], $categoryData);
        }

        $this->info('Categories successfully inserted...');
    }
}
