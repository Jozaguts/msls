<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','paternal_name','maternal_name','birthdate','phone','type'];
}
