<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;
    protected $table = 'purchases';
    protected $fillable = ['customer_id', 'order_id', 'product_id', 'quantity', 'number_of_meters', 'created_at','updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
