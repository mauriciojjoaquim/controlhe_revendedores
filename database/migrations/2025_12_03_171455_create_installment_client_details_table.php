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
        Schema::create('installment_client_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_number_id');
            $table->bigInteger('client_id');
            $table->bigInteger('user_id');
            $table->string('year', 50)->nullable();
            $table->string('month', 50)->nullable();
            $table->integer('quantity_product')->nullable();
            $table->integer('installment_number');
            $table->decimal('installment_price',10 ,2);
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
        Schema::dropIfExists('installment_client_details');
    }
};
/**
 
 */