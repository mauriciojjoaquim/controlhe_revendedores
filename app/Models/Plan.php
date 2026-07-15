<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'product_id',
        'price_id',
        'percente',
        'customer_status',
        'price',
        'discount_price',
    ];
}