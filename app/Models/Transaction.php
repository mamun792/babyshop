<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['account_id', 'purpose_id', 'transaction_type', 'transaction_date', 'amount', 'comments', 'user_id', 'document'];


    public function scopeByType(Builder $query, $type)
    {
        
        return $query->where('transaction_type', $type);
    }

    

    public function scopeByDateRange(Builder $query, $startDate, $endDate)
    {
        if ($startDate) {
            $query->where('transaction_date', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('transaction_date', '<=', $endDate);
        }

        return $query;
    }

    public function scopeByAccountType(Builder $query, $accountTypeId)
    {
        return $query->where('account_id', $accountTypeId);
    }


    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function purpose()
    {
        return $this->belongsTo(Purpose::class);
    }
}
