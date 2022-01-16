<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Design extends Model
{
    use SoftDeletes;
    protected $table = 'designs';
    protected $fillable = [
        'name',
        'type_id',
        'description',
        'vendor_id',
        'created_at',
        'updated_at'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function getPhoto($val)
    {
        return ($val !== null) ? asset('public/assets/images/products/designs/' . $val) : "";

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
