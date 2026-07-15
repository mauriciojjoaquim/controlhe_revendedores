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
        Schema::create('total_annual_closings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('client_id')->nullable();
            $table->string('year', 50)->nullable();
            $table->string('month', 50)->nullable();
            $table->integer('product_quantity')->nullable();
            $table->decimal('reselle_price', 10, 2)->nullable();
            $table->decimal('magazine_price', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_annual_closings');
    }
};