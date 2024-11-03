<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
       'purchase_name',
        'purchase_date',
        'invoice_number',
        'supplier_id',
        'document',
       'product_code',

        'comment'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'purchase_id');
    }

    
  
}
