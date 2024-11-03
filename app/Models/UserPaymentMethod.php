<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPaymentMethod extends Model
{
    protected $fillable = ['user_id', 'name', 'info'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getInfoAttribute($value)
    {
        return json_decode($value, true);
    }
}
