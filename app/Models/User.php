<?php

namespace App\Models;

use App\Models\Verification\InstallmentClientDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Autheticable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Autheticable
{
    use HasFactory, Notifiable, SoftDeletes, Billable;
    
    
    public function detail(): HasOne
    {
        // Each user has one user_details
        return $this->hasOne(UserDetail::class);
    }

    // 
    public function department(): BelongsTo
    {
        // this belongs to a department
        return $this->belongsTo(Department::class);  
    }

    public function settingsdetail(): HasOne
    {
        // this belongs to a department
        return $this->hasOne(SettingsDetail::class, 'id', 'user_id');  
    }
    
    public function user_order_list(): BelongsTo
    {
        // this belongs to a department
        return $this->belongsTo(UserOrderList::class);
    }
    
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class,'id' , 'user_id');
    }
    
    public function client(): HasOne
    {
        // Each user has one user_details
        return $this->hasOne(Client::class, 'user_id', 'id');
    }

    public function installmentClientDetails(): BelongsToMany
    {
        return $this->belongsToMany(InstallmentClientDetail::class,'id', 'user_id');
    }
    
    public function installmentClientDetail(): BelongsTo
    {
        // this belongs to a 
        return $this->belongsTo(InstallmentClientDetail::class,'id', 'user_id');  
    }
    
    public function userinstallmentdetail(): HasOne
    {
        // Each user has one User Installment Detail
        return $this->hasOne(UserInstallmentDetail::class, 'id', 'user_id');
    }
    
    public function userinstallmentdetails(): BelongsTo
    {
        // Each user has one User Installment Details
        return $this->belongsTo(UserInstallmentDetail::class, 'id', 'user_id');
    }

}