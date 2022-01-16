<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fabric extends Model
{
    use SoftDeletes;
    protected $table = 'fabrics';
    protected $fillable = [
        'name',
        'color_id',
        'description',
        'vendor_id',
        'created_at',
        'updated_at'
    ];

    public function colors()
    {
        return $this->belongsToMany(Color::class,'fabric_colors','fabric_id','color_id');
    }

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('public/assets/images/products/fabrics/' . $val) : "";

    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }


    public function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
