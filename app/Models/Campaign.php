<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;  

    protected $guarded = [] ;

   /* public function products()
    {
        return $this->belongsToMany(Product::class, 'product_campaigns', 'campaign_id', 'product_id');
    } */

    function productCampaigns() : HasMany {
        return $this->hasMany(ProductCampaign::class, 'campaign_id', 'id');
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, ProductCampaign::class, 'campaign_id', 'id', 'id', 'product_id');
    }


    public function productm()
    {
        return $this->hasMany(Product::class);
    }

   

}
