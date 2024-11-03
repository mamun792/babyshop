<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = ['user_id', 'product_id', 'quantity', 'campaign_id'];

    // public function options()
    // {
    //     return $this->belongsToMany(Option::class);
    // }
    public function options()
    {
        return $this->hasMany(CartItemOption::class, 'cart_item_id');
    }

    public function cartItems()
    {
        return $this->belongsToMany(CartItem::class, 'cart_item_option');
    }

    public function products(){
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    public function cartItemOptions() {
        return $this->hasMany(CartItemOption::class, 'cart_item_id', 'id');
    }

    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); // Adjust 'product_id' if needed
    }

    // If there's a relationship with Campaigns
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id'); // Assuming 'campaign_id' in cart_items
    }



}
