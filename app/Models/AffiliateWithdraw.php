<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateWithdraw extends Model
{
    protected $fillable=[
        'payment_method','user_id','amount','status'
    ];

    public function user(){
       return $this->belongsTo(User::class);
    }

    public function getPaymentMethodAttribute($value)
    {
        return json_decode($value);
    }

}
