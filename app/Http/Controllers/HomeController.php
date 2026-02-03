<?php

namespace App\Http\Controllers;

use App\Models\MissionLog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get all mission logs
        $missions = MissionLog::orderBy('launch_year')->get();

        // Gather system information
        $systemInfo = [
            'version' => config('app.version', env('APP_VERSION', '1.0.0')),
            'php_version' => phpversion(),
            'server_time' => now()->format('Y-m-d H:i:s T'),
            'hostname' => gethostname(),
            'environment' => config('app.env', 'production'),
        ];

        return view('welcome', [
            'missions' => $missions,
            'systemInfo' => $systemInfo,
        ]);
    }
}
