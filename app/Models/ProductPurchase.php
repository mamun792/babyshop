<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPurchase extends Model
{
    use HasFactory;
    protected $table = 'product_purchases';

  
    protected $fillable = [
        'purchase_name',
        'purchase_date',
        'invoice_number',
        'supplier_id',
        'document',
        'product_code',
        'quantity',
        'price',
        'comment',
        'purchase_id',
        'total_price',
        
    ];

}
