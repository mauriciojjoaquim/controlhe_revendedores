<?php

namespace App\Models;

use App\Models\Adm\MagazineNumber\MagazineNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Supplier extends Model
{
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'supplier_id', 'id');
    }

    public function magazineNumber(): BelongsTo
    {
        return $this->belongsTo(MagazineNumber::class, 'supplier_id', 'id');
    }
}