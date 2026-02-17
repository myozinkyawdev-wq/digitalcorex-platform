<?php

namespace App\Console\Commands\Seeders\Products;

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
        foreach ($this->getUnits() as $unit) {
            $variantUnit = VariantUnit::updateOrCreate([
                'name' => $unit['name'],
            ], $unit);

            $variantUnit->children()->createMany($unit['children']);
        }

        $this->info('Variant units successfully inserted...');
    }

    private function getUnits()
    {
        return [
            [
                'name' => 'Durations',
                'order' => 1,
                'is_unit' => false,
                'children' => [
                    [
                        'name' => 'Hours',
                        'type' => 'hours',
                        'order' => 1,
                        'is_unit' => true,
                    ],
                    [
                        'name' => 'Days',
                        'type' => 'days',
                        'order' => 2,
                        'is_unit' => true,
                    ],
                    [
                        'name' => 'Week',
                        'type' => 'week',
                        'order' => 3,
                        'is_unit' => true,
                    ],
                    [
                        'name' => 'Years',
                        'type' => 'years',
                        'order' => 4,
                        'is_unit' => true,
                    ],
                    [
                        'name' => 'Lifetime',
                        'type' => 'lifetime',
                        'order' => 5,
                        'is_unit' => true,
                    ],
                ]
            ],
            [
                'name' => 'Data Storage',
                'order' => 2,
                'is_unit' => false,
                'children' => [
                    [
                        'name' => 'Megabytes (MB)',
                        'type' => 'MB',
                        'order' => 1,
                        'is_unit' => true,
                    ],
                    [
                        'name' => 'Gigabytes (GB)',
                        'type' => 'GB',
                        'order'=> 2,
                        'is_unit' => true,
                    ],
                    [
                        'name' => 'Terabytes (TB)',
                        'type' => 'TB',
                        'order' => 3,
                        'is_unit' => true,
                    ],
                ]
            ],
            [
                'name' => 'Usage Limit',
                'order' => 3,
                'is_unit' => false,
                'children' => [
                    [
                        'name' => 'Devices',
                        'type' => 'devices',
                        'order' => 1,
                        'is_unit' => true,
                    ],
                    [
                        'name' => 'Tokens/Credits',
                        'type' => 'tokens',
                        'order' => 2,
                        'is_unit' => true,
                    ],
                    [
                        'name' => 'Accounts',
                        'type' => 'accounts',
                        'order' => 3,
                        'is_unit' => true,
                    ],
                    [
                        'name' => 'Users',
                        'type' => 'users',
                        'order' => 3,
                        'is_unit' => true,
                    ],
                    [
                        'name' => 'Unlimited',
                        'type' => 'unlimited',
                        'order' => 3,
                        'is_unit' => true,
                    ],
                ]
            ],
        ];
    }
}
