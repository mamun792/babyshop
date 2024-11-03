<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPurchase extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'sold',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [] ;

    public function getStockAttribute()
    {
        return $this->quantity - $this->sold;
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
