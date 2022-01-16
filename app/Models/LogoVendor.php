<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogoVendor extends Model
{
    use SoftDeletes;
    protected $table = 'logo_vendors';
    protected $fillable = ['vendor_id' ,'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function getPhoto($val)
    {
        return ($val !== null) ? asset('/public/assets/images/vendors/logo/' . $val) : "";

    }
}
