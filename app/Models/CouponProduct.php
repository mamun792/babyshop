<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponProduct extends Model
{
    use HasFactory;
    protected $table = 'coupon_product';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
