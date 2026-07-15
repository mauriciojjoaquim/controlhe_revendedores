<?php

namespace App\Models;

use App\Models\Verification\InstallmentClientDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ClientOrderDetail extends Model
{

    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    
    protected $fillable = [
        'client_id',
        'user_id',
        'total_price',
        'number_of_installments',
        'price_per_installment',
        'installments_paid',
        'installment_due_date',
        'installment_payment_date',
        'customer_status',
        'situation',
    ];
    
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'client_id', 'id');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function installmentClientDetails(): BelongsToMany
    {
        return $this->belongsToMany(InstallmentClientDetail::class, 'client_id', 'id');
    }
}