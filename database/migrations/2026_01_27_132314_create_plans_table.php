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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('product_id')->nullable();
            $table->string('price_id')->nullable();
            $table->integer('percente')->nullable();
            $table->string('customer_status', 30)->nullable();
            $table->decimal('price',10 ,2)->nullable();
            $table->decimal('discount_price',10 ,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};