<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
  use HasFactory;
  protected $guarded = [];
  // Define the inverse relationship
  public function attribute()
  {
    return $this->belongsTo(Attribute::class);
  }

  public function products()
  {
    return $this->belongsToMany(Product::class, 'product_options', 'product_option_id', 'product_id')
      ->withTimestamps();
  }



  public function orderItems()
  {
    return $this->belongsToMany(OrderItem::class, 'option_order_item');
  }

  public function productOptions()
    {
        return $this->hasMany(ProductOption::class);
    }

    
}
