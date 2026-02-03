<?php

namespace App\Console\Commands;

use App\Models\MissionLog;
use Illuminate\Console\Command;

class ResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset {--force : Skip confirmation prompt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all mission data from the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = MissionLog::count();

        if ($count === 0) {
            $this->info('Database is already empty.');
            $this->newLine();
            return Command::SUCCESS;
        }

        $forceMode = $this->option('force');

        if (!$forceMode) {
            $this->warn('This will delete ALL mission records (' . $count . ' mission' . ($count !== 1 ? 's' : '') . ').');
            $this->newLine();

            if (!$this->confirm('Are you sure you want to reset?', false)) {
                $this->info('Reset cancelled.');
                $this->newLine();
                return Command::SUCCESS;
            }
        } else {
            $this->info('Force mode: Proceeding with reset...');
        }

        $this->newLine();
        $this->info('Clearing mission data...');

        // Delete all mission records
        MissionLog::truncate();

        $this->newLine();
        $this->info('✓ Database has been reset successfully!');
        $this->newLine();

        return Command::SUCCESS;
    }
}
