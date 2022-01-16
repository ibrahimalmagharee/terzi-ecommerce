<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;
    protected $table = 'types';
    protected $fillable = ['name', 'created_at','updated_at'];
}
