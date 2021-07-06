<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenaltyGoalkeeper extends Model
{
    use HasFactory, softDeletes;
    protected $fillable = ['match_id','team_id', 'player_id'];
}
