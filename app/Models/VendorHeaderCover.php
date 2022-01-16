<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorHeaderCover extends Model
{
    use SoftDeletes;
    protected $table = 'vendor_header_covers';
    protected $fillable = ['vendor_id', 'photo', 'created_at','updated_at'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('public/assets/images/vendors/headerCover/' . $val) : "";

    }
}
