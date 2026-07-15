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
        Schema::create('my_sales_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('add_to_cart_id')->nullable();
            $table->string('code', 255)->nullable();
            $table->string('year', 255)->nullable();
            $table->string('month', 255)->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('point')->nullable();
            $table->decimal('price',10 ,2)->nullable();
            $table->decimal('purchase_price',10 ,2)->nullable();
            $table->decimal('total_purchase',10 ,2)->nullable();
            $table->boolean('closed_order')->default(false);
            $table->dateTime('order_date')->nullable();
            $table->dateTime('purchase_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_sales_products');
    }
};