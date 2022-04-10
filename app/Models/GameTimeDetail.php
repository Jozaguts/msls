<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameTimeDetail extends Model
{
    use HasFactory;
    protected $fillable = ['game_id', 'first_time_start', 'first_time_end', 'second_time_start',
        'second_time_end', 'prorogue_minutes_start', 'first_time_extra_time', 'second_time_extra_time',
    ];
}
