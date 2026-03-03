<?php

namespace App\Console\Commands\Seeders\User;

use App\Models\AccountPlatform;
use Illuminate\Console\Command;

class AccountPlatformSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:account-platforms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To insert product account platform seeder.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (config('utility.account_platforms') as $accountPlaform) {
            AccountPlatform::updateOrCreate([
                'name' => $accountPlaform['name'],
            ], $accountPlaform);
        }

        $this->info('Account platforms successfully inserted...');
    }
}
