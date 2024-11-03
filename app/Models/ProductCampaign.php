<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCampaign extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'product_campaigns';
    /* public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }*/


    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'campaign_product', 'campaign_id', 'product_id');
    }
}
