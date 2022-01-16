<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;
    protected $table = 'coupons';
    protected $fillable = [
        'vendor_id',
        'code',
        'type',
        'percent_discount',
        'start_datetime',
        'end_datetime',
        'status',
        'created_at',
        'updated_at'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
