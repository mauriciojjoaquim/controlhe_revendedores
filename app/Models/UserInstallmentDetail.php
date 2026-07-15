<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

class UserInstallmentDetail extends Model
{
    use HasFactory;
    use Notifiable;


    protected $fillable = [
        'user_id',
        'order_number_id',
        'month',
        'year',
        'installment_number',
        'installment_price',
        'customer_status',
        'due_date',
        'payment_date',
    ];

    public function user(): HasOne
    {
        // Each user has one User Installment Detail
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function users(): BelongsToMany
    {
        // Each user has one User Installment Details
        return $this->belongsToMany(User::class, 'id', 'user_id');
    }
  
}