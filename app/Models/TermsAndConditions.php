<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermsAndConditions extends Model
{
    use SoftDeletes;
    protected $table = 'terms_and_conditions';
    protected $fillable = ['description', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];


}
