<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionLog extends Model
{
    protected $fillable = [
        'mission_name',
        'destination',
        'launch_year',
        'status',
        'agency',
        'logged_at',
    ];

    protected $casts = [
        'launch_year' => 'integer',
        'logged_at' => 'datetime',
    ];
}
