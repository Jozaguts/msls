<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lineup extends Model
{
    use HasFactory;
    protected $fillable = ['game_id', 'player_id', 'first_team_player','round'];
}
