<?php

namespace App\Models\Verification;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CustomerBasedVerificationDetail extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'zip_code',
        'address',
        'number',
        'complement',
        'neighborhood',
        'city',
        'phone',
        'register_date'
    ];

    public function customerBasedVerification(): BelongsTo
    {
        return $this->belongsTo(CustomerBasedVerification::class, 'id', 'custon_id');
    }
}