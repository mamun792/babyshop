<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;
    protected $guarded = [] ;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function option()
    {
        return $this->belongsTo(Option::class, 'product_option_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    

  

   
}
