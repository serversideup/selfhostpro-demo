<?php

namespace App\Console\Commands;

use App\Models\MissionLog;
use Illuminate\Console\Command;

class StatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show mission database status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $missionCount = MissionLog::count();

        if ($missionCount === 0) {
            $this->warn('No missions seeded yet.');
            $this->newLine();
            $this->info('Run: php artisan initialize --force to seed space missions.');
            $this->newLine();
            return Command::SUCCESS;
        }

        $this->info('✓ Mission database is populated');
        $this->newLine();

        $latestMission = MissionLog::latest('logged_at')->first();

        // Display status
        $this->table(
            ['Field', 'Value'],
            [
                ['Status', '✓ Seeded'],
                ['Total Missions', $missionCount],
                ['Last Seeded', $latestMission->logged_at->format('F j, Y \a\t g:i A')],
                ['Hostname', gethostname()],
                ['PHP Version', phpversion()],
                ['App Version', config('app.version', env('APP_VERSION', '1.0.0'))],
            ]
        );

        $this->newLine();

        // Display missions table
        $this->info('Space Missions:');
        $this->newLine();

        $this->table(
            ['Mission', 'Destination', 'Year', 'Status', 'Agency'],
            MissionLog::orderBy('launch_year')->get()->map(fn($m) => [
                $m->mission_name,
                $m->destination,
                $m->launch_year,
                $m->status,
                $m->agency,
            ])->toArray()
        );

        $this->newLine();

        return Command::SUCCESS;
    }
}
