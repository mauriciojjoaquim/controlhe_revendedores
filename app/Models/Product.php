<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'supplier_id',
        'category_id',
        'name',
        'description',
        'departament',
        'purchase_price',
        'resale_price',
        'percentage',
        'photo_url',
        'code',
        'non_production',
        'confirmed',
    ];

    public function supplier(): HasOne
    {
        // Each user has one 
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function category(): HasOne
    {
        // Each user has one user_details
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    
    public function customerstockdetail(): HasOne
    {
        // Each user has one Customer Stock Details
        return $this->hasOne(CustomerStockDetail::class);
    }
}