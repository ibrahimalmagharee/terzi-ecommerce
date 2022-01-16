<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutUs extends Model
{
    use SoftDeletes;
    protected $table = 'about_us';
    protected $fillable = ['about' , 'link', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    public function getPhoto($val)
    {
        return ($val !== null) ? asset('public/assets/images/aboutSite/' . $val) : "";

    }
}
