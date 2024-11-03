<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table = 'user_addresses';
    protected $fillable = [
        'user_id',
        'full_name',
        'mobile_number',
        
        'area',
        'address',
        'landmark',
        'label',
        'is_default_delivery',
        'is_default_billing',
    ];

}
