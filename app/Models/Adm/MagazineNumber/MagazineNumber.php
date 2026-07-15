<?php

namespace App\Models\Adm\MagazineNumber;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MagazineNumber extends Model
{
    public function supplier(): HasOne
    {
        // Each user has one 
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }
}