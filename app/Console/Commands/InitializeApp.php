<?php

namespace App\Console\Commands;

use App\Models\MissionLog;
use Illuminate\Console\Command;

class InitializeApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'initialize {--force : Seed all space missions without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with space mission data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $forceMode = $this->option('force');

        $this->info('🚀 Space Mission Database Seeder');
        $this->newLine();

        // Check if already seeded
        $existingCount = MissionLog::count();
        if ($existingCount > 0 && !$forceMode) {
            $this->warn("Database already contains {$existingCount} mission(s).");
            $this->newLine();

            if (!$this->confirm('Do you want to reseed? This will clear existing data.', false)) {
                $this->info('Seeding cancelled.');
                return Command::SUCCESS;
            }
            $this->newLine();
        }

        // Clear existing data if reseeding
        if ($existingCount > 0) {
            MissionLog::truncate();
            $this->info('✓ Cleared existing mission data');
        }

        $this->info('Seeding space missions...');
        $this->newLine();

        $missions = $this->getSpaceMissions();
        $now = now();

        foreach ($missions as $mission) {
            MissionLog::create([
                'mission_name' => $mission['name'],
                'destination' => $mission['destination'],
                'launch_year' => $mission['launch_year'],
                'status' => $mission['status'],
                'agency' => $mission['agency'],
                'logged_at' => $now,
            ]);
        }

        $this->info('✅ Successfully seeded ' . count($missions) . ' space missions!');
        $this->newLine();

        // Display the missions in a table
        $this->table(
            ['Mission', 'Destination', 'Year', 'Status', 'Agency'],
            collect($missions)->map(fn($m) => [
                $m['name'],
                $m['destination'],
                $m['launch_year'],
                $m['status'],
                $m['agency'],
            ])->toArray()
        );

        $this->newLine();
        $this->comment('Restart the container - your data will still be here.');

        return Command::SUCCESS;
    }

    /**
     * Get space mission data
     *
     * @return array
     */
    private function getSpaceMissions(): array
    {
        return [
            ['name' => 'Apollo 11', 'destination' => 'Moon', 'launch_year' => 1969, 'status' => 'completed', 'agency' => 'NASA'],
            ['name' => 'Voyager 1', 'destination' => 'Interstellar', 'launch_year' => 1977, 'status' => 'active', 'agency' => 'NASA'],
            ['name' => 'Voyager 2', 'destination' => 'Interstellar', 'launch_year' => 1977, 'status' => 'active', 'agency' => 'NASA'],
            ['name' => 'Mars Perseverance', 'destination' => 'Mars', 'launch_year' => 2020, 'status' => 'active', 'agency' => 'NASA'],
            ['name' => 'James Webb', 'destination' => 'L2 Orbit', 'launch_year' => 2021, 'status' => 'active', 'agency' => 'NASA/ESA'],
            ['name' => 'Artemis I', 'destination' => 'Moon', 'launch_year' => 2022, 'status' => 'completed', 'agency' => 'NASA'],
            ['name' => 'Europa Clipper', 'destination' => 'Jupiter', 'launch_year' => 2024, 'status' => 'active', 'agency' => 'NASA'],
            ['name' => 'Hubble', 'destination' => 'Earth Orbit', 'launch_year' => 1990, 'status' => 'active', 'agency' => 'NASA/ESA'],
            ['name' => 'Rosetta', 'destination' => 'Comet 67P', 'launch_year' => 2004, 'status' => 'completed', 'agency' => 'ESA'],
            ['name' => 'New Horizons', 'destination' => 'Pluto/Kuiper', 'launch_year' => 2006, 'status' => 'active', 'agency' => 'NASA'],
        ];
    }
}
