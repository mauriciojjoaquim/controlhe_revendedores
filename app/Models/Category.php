<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'category_id', 'id');
    }
}