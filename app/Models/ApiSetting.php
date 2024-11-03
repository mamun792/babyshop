<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiSetting extends Model
{
    use HasFactory;

    protected $table = 'api_settings';

    protected $fillable = [
        'api_key',
        'secret_key',
    ];
}
