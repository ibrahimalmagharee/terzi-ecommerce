<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsagePolicy extends Model
{
    use SoftDeletes;
    protected $table = 'usage_policies';
    protected $fillable = ['description', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
}
