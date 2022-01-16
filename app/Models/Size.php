<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use SoftDeletes;
    protected $table = 'sizes';
    protected $fillable = [
        'customer_id',
        'product_id',
        'category_id',
        'name',
        'chest_circumference',
        'waistline',
        'buttock_circumference',
        'length_by_chest',
        'chest_length',
        'shoulder_length',
        'back_view',
        'neck_length',
        'neck_width',
        'neck_circumference',
        'distance_between_breasts',
        'arm_length',
        'arm_circumference',
        'armpit_length',
        'created_at',
        'updated_at'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'size_products','size_id','product_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
