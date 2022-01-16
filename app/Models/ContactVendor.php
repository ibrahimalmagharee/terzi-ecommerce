<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactVendor extends Model
{
    use SoftDeletes;
    protected $table = 'contact_vendors';
    protected $fillable = [
        'vendor_id',
        'email',
        'phone_number',
        'address_request',
        'message',
        'created_at',
        'updated_at'
    ];

    protected $hidden = ['created_at','updated_at'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
