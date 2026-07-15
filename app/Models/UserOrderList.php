<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserOrderList extends Model
{
    public function product_list(): HasOne
    {
        // Each user has one product_list
        return $this->hasOne(ProductList::class, 'id', 'product_list_id');
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'id', 'user_id');
    }
}
