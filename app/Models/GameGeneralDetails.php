<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameGeneralDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'game_id',
        'local_color',
        'away_color',
        'local_captain_id',
        'away_captain_id',
        'referee_id',
        'first_assistance_referee_id',
        'second_referee_id',
        'third_referee_id',
        ];
}
