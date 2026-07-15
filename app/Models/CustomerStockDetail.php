<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CustomerStockDetail extends Model
{
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): HasOne
    {
        // Each user has one user_details
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}