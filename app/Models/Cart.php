<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'email',
        'product_name',
        'product_image',
        'product_price',
        'total_price',
        'quantity',
        
    ];
}
