<?php

namespace App\Models;

use App\Models\Verification\InstallmentClientDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    
    public function user(): HasOne
    {
        // Each user has one user_details
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function clientdetail(): HasOne
    {
        // Each user has one user_details
        return $this->hasOne(ClientDetail::class, 'client_id', 'id');
    }
    
    public function clientorderdetail(): HasOne
    {
        // Each user has one user_details
        return $this->hasOne(ClientOrderDetail::class, 'client_id', 'id');
    }

    public function installmentClientDetail(): HasOne
    {
        // Each user has one user_details
        return $this->hasOne(InstallmentClientDetail::class, 'id', 'client_id');
    }
    
    public function customerstockdetail(): BelongsTo
    {
        // this belongs to a client orden detail
        return $this->belongsTo(CustomerStockDetail::class, 'id', 'client_id');
    }
  
}