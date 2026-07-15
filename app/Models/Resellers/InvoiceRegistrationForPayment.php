<?php

namespace App\Models\Resellers;

use Illuminate\Database\Eloquent\Model;

class InvoiceRegistrationForPayment extends Model
{
    protected $fillable = [
        'invoice_status',
        'invoice_number',
        'description',
        'price',
        'barcode',
        'pix_code',
        'installment_number',
        'invoice_file',
        'due_date',
        'payment_date',
    ];
    
}