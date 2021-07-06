<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['match_id', 'play_stage', 'team_id', 'win_lose', 'decided_by', 'goal_score', 'penalty_score', 'assistant_referee_id', 'goalkeeper_id',
];
}
