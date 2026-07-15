<?php

namespace App\Models\Verification;

use App\Models\Client;
use App\Models\ClientOrderDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class InstallmentClientDetail extends Model
{

    use HasFactory;
    use Notifiable;


    protected $fillable = [
        'order_number_id',
        'client_id',
        'user_id',
        'quantity_product',
        'installment_number',
        'installment_price',
        'due_date',
        'payment_date',
    ];

    

    
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function clientorderdetail(): BelongsTo
    {
        return $this->belongsTo(ClientOrderDetail::class, 'order_number_id', 'id');
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'id', 'user_id');
    }
}