<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeaderIndex extends Model
{
    use SoftDeletes;
    protected $table = 'header_indices';
    protected $fillable = ['description' , 'header', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    public function getPhoto($val)
    {
        return ($val !== null) ? asset('public/assets/images/index/topHeader/' . $val) : "";

    }
}
