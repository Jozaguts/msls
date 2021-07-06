<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Match extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['date','result','score','mvp','referee_id','stop1','stop2'];
}
