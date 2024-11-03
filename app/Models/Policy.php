<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

      protected $primaryKey = 'type';


      public $incrementing = false;
  
     
      protected $keyType = 'string';
  
     
      protected $fillable = ['type', 'content'];
}
