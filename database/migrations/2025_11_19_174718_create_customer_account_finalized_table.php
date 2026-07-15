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
        Schema::create('customer_account_finalized', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->integer('number_of_installments')->nullable();
            $table->decimal('price_per_installment', 10, 2)->nullable();
            $table->integer('installments_paid')->nullable();
            $table->dateTime('installment_due_date')->nullable();
            $table->dateTime('installment_payment_date')->nullable();
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
        Schema::dropIfExists('customer_account_finalized');
    }
};