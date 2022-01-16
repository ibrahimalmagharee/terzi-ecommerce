<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactCustomer extends Model
{
    use SoftDeletes;
    protected $table = 'contact_customers';
    protected $fillable = [
        'customer_id',
        'first_name',
        'last_name',
        'email',
        'message',
        'created_at',
        'updated_at'
    ];

    protected $hidden = ['created_at','updated_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
