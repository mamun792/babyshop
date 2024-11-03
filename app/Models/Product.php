<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [] ;
   

    protected $fillable = [
        'name',
        'product_code',
        'quantity',
        'price',
        'discount_price', // New field for previous price
        'slug',
        'short_description',
        'description',
        'specifications',
        'featured_image',
        'gallery_image_one',
        'gallery_image_two',
        'gallery_image_three',
        'youtube_link',
        'meta_title',
        'meta_description',
        'is_published',
        'is_flash',
        'is_new_arrival',
        'flash_expires_date_at',
        'type', // Enum field
        'category_id',
        'sub_category_id',
        'brand_id',
        'user_id',
       'is_affiliate',
        'sold',
        'commission_type',
        'commission_amount'
    ];
    

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function productOptions()
    {
        return $this->hasMany(ProductOption::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }



    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_product');
    }

    public function isInWishlist($userId)
    {
        return $this->wishlists()->where('user_id', $userId)->exists();
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }


    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'product_campaigns', 'product_id', 'campaign_id');
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productCampaigns()
    {
        return $this->hasMany(ProductCampaign::class, 'product_id', 'id');
    }

   
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
   
  
    public function productCampaignss()
    {
        return $this->hasMany(ProductCampaign::class);
    }
    
    public function campaignss()
    {
        return $this->hasManyThrough(Campaign::class, ProductCampaign::class);
    }

    public function option()
    {
        return $this->belongsToMany(Option::class, 'product_options', 'product_id', 'product_option_id')
            ->withPivot('id');
    }

    public function scopeAffiliate($query)
    {
        return $query->where('is_affiliate', 1);
    }

    public function subcategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'sub_category_id'); 
    }

    

}
