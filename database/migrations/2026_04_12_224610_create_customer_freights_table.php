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
        Schema::create('customer_freights', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('client_id')->nullable();
            $table->bigInteger('freight_id')->nullable();
            $table->bigInteger('order_number_id')->nullable();
            $table->bigInteger('code_freight_id')->nullable();
            $table->decimal('price',10 ,2)->nullable();
            $table->string('confirmation_status', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_freights');
    }
};