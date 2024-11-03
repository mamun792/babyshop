<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function isExpired()
    {
        return $this->expiry_date < now();
    }

    protected $casts = [
        'valid_from' => 'date',
        'valid_to' => 'date',
    ];

    public function couponProducts()
    {
        return $this->hasMany(CouponProduct::class, 'coupon_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'coupon_product');
    }

  

}
