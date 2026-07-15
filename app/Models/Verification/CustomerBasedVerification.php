<?php

namespace App\Models\Verification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CustomerBasedVerification extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    
    public function customerBasedVerificationDetail(): HasOne
    {
        // Each user has one user_details
        return $this->hasOne(CustomerBasedVerificationDetail::class,  'custon_id', 'id');
    }
}