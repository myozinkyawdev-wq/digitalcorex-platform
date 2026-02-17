<?php

namespace App\Console\Commands\Seeders\Category;

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
        foreach ($this->getCategories() as $categoryData) {
            Category::query()->updateOrCreate([
                'name' => $categoryData['name'],
            ], $categoryData);
        }

        $this->info('Categories successfully inserted...');
    }

    private function getCategories(): array
    {
        return [
            [
                'name' => 'VPN & Privacy',
                'slug' => 'vpn-privacy',
                'order' => 1,
            ],
            [
                'name' => 'Streaming',
                'slug' => 'streaming',
                'order' => 2,
            ],
            [
                'name' => 'Social Media',
                'slug' => 'social-premium',
                'order' => 3,
            ]
        ];
    }
}
