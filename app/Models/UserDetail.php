<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class UserDetail extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'address',
        'zip_code',
        'number',
        'complement',
        'neighborhood',
        'city',
        'phone',
        'salary',
        'admission_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
