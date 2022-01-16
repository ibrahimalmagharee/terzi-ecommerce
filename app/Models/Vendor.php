<?php

namespace App\Models;

use App\Notifications\Vendor\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use Notifiable, SoftDeletes;
    protected $table = 'vendors';
    protected $fillable = [
        'name',
        'location',
        'commercial_registration_No',
        'mobile_No',
        'national_Id',
        'email',
        'type_activity',
        'password',
        'service_id',
        'created_at',
        'updated_at'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('public/assets/images/vendors/profile/' . $val) : "";

    }

    public function getPhotoHeaderCover($val)
    {
        return ($val !== null) ? asset('public/assets/images/vendors/headerCover/' . $val) : "";

    }
    public function product()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'vendor_id');
    }

    public function headerCover()
    {
        return $this->hasOne(VendorHeaderCover::class);
    }

}
