<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logo extends Model
{
    use SoftDeletes;
    protected $table = 'logos';
    protected $fillable = ['photo' ,'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('/public/assets/images/logo_site/' . $val) : "";

    }
}
