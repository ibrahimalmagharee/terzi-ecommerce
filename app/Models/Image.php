<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    protected $fillable = ['imageable_id','imageable_type','photo','created_at','updated_at'];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getPhotoDesign($val)
    {
        return ($val !== null) ? asset('public/assets/images/products/designs/' . $val) : "";

    }

    public function getPhotoFabric($val)
    {
        return ($val !== null) ? asset('public/assets/images/products/fabrics/' . $val) : "";

    }

    public function design()
    {
        return $this->belongsTo(Design::class,'imageable_id');
    }
}
