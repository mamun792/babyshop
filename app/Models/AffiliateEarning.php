<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateEarning extends Model
{
    protected $fillable=[
        'product_details','user_id','commission_details','commission_amount'
    ];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function getProductDetailsAttribute($value)
    {
        return json_decode($value);
    }

    public function getCommissionDetailsAttribute($value)
    {
        return json_decode($value);
    }


}
