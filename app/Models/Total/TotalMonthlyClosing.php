<?php

namespace App\Models\Total;

use Illuminate\Database\Eloquent\Model;

class TotalMonthlyClosing extends Model
{
    protected $fillable = [
        'user_id',
        'client_id_id',
        'year',
        'month', 
        'product_quantity',
        'reselle_price',
        'magazine_price', 
        'reseller_profit',

];
}