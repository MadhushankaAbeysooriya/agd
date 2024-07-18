<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetSearchSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-search-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset search_count field for all users to zero';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::query()->update(['search_count' => 0]);

        $this->info('All user search counts have been reset to zero.');
    }
}
