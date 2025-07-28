<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    use HasFactory;
          

    protected $fillable = [
        'cover_name',
        'cover_price',
        'quantity',
        'description',
        'model',
        'cover_type',
        'cover_img',
    ];

    public function mobile()
    {
        return $this->belongsTo(Mobile::class);
    }
    
}
