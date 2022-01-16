<?php

namespace App\Models;

use App\Notifications\Customer\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable, SoftDeletes;
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'password',
        'service_id',
        'created_at',
        'updated_at'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }


    public function wishlistProduct()
    {
        return $this->belongsToMany(Product::class,'product_wishlists')->withTimestamps();
    }

    public function wishlistHasProduct($product_id)
    {
        return self::wishlistProduct()->where('product_id', $product_id)->exists();
    }

    public function basketProduct()
    {
        return $this->hasMany(BasketProduct::class);
    }

    public function basketHasProduct($product_id)
    {
        return self::basketProduct()->where('product_id', $product_id)->exists();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }
}
