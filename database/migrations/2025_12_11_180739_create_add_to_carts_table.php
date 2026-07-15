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
        Schema::create('add_to_carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('client_id');
            $table->bigInteger('product_id');
            $table->bigInteger('purchase_status_id')->nullable();
            $table->string('code');
            $table->integer('amount');
            $table->integer('point');
            $table->decimal('price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->dateTime('purchase_date');
            $table->boolean('closed_order')->default(false);
            $table->dateTime('completion_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_to_carts');
    }
};