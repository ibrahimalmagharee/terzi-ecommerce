<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasketProduct extends Model
{
    use SoftDeletes;
    protected $table = 'basket_products';
    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity',
        'status',
        'number_of_meters',
        'created_at',
        'updated_at'
    ];


}
