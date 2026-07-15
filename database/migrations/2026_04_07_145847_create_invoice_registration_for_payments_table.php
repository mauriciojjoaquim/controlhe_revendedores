<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_registration_for_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('invoice_status', 50)->nullable();
            $table->string('invoice_number', 50);
            $table->string('description', 250);
            $table->decimal('price',10 ,2)->nullable();
            $table->text('barcode');
            $table->text('pix_code')->nullable();
            $table->integer('installment_number')->nullable();
            $table->string('invoice_file', 255)->nullable();
            $table->dateTime('due_date');
            $table->dateTime('payment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_registration_for_payments');
    }
};


/**
  
    registro de boleto para pagamentos
    estatu_da_nota
    numero_da_nota_fiscal
    descricao
    price
    codigo_de_barra
    codigo_pix
    numero_da_parcela
    arquivo_da_nota
    data_vencimemto
    data_pagamento


    Payment slip registration
    invoice_status
    invoice_number
    description
    barcode
    PIX code
    installment_number
    invoice_file
    due_date
    payment_date
  
  invoice_status
  payment_date
 */