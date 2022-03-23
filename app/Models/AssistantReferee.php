<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssistantReferee extends Model
{
    use HasFactory, SoftDeletes;
    //todo remover este modelo integrarlo a referee y cololar un tipo de referee
    protected $fillable = ['name','age'];
}
