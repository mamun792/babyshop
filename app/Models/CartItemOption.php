<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItemOption extends Model
{
    use HasFactory;
    
    protected $table = 'cart_item_option';

    protected $fillable = [
        'cart_item_id',
        'option_id',
    ];
    protected $guarded = [];

    public function cartItem()
    {
        return $this->belongsTo(CartItem::class);
    }

    // Relationship to Option
    public function option() // This defines the relationship to the Option model
    {
        return $this->belongsTo(Option::class, 'option_id'); // Make sure to specify the foreign key if it's not the default
    }

}
