<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Symfony\Component\Translation\t;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'price',
        'offer',
        'vendor_id',
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function design()
    {
        return $this->morphTo();
    }
    public function fabric()
    {
        return $this->morphTo();
    }

}
