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
        Schema::create('user_installment_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('order_number_id')->nullable();
            $table->string('month', 50)->nullable();
            $table->string('year', 50)->nullable();
            $table->integer('installment_number')->nullable();
            $table->string('customer_status', 5)->nullable();
            $table->decimal('installment_price',10 ,2)->nullable();
            $table->dateTime('due_date')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_installment_details');
    }
};