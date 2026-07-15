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
        Schema::create('client_order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id');
            $table->bigInteger('user_id');
            $table->decimal('total_price', 10, 2);
            $table->integer('number_of_installments');
            $table->decimal('price_per_installment', 10, 2);
            $table->integer('installments_paid')->nullable();
            $table->dateTime('installment_due_date')->nullable();
            $table->dateTime('installment_payment_date')->nullable();
            $table->string('customer_status', 5)->nullable();
            $table->string('situation', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_order_details');
    }
};
/**
 
    total_price
    number_of_installments
    price per_installment
    installments_paid
    installment_due_date
    Installment payment date
    customer_status
    situation

    preço total
    numero pacela
    preço parcelas
    parcelas paga
    data vencimento parcela
    data pagamento parcela
    situação cliente
    Situação

 
 */