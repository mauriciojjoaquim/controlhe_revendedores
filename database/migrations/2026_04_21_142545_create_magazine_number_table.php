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
        Schema::create('magazine_numbers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('supplier_id')->nullable();
            $table->boolean('activated')->default(false);
            $table->string('number', 255)->nullable();
            $table->string('start_data', 255)->nullable();
            $table->string('end_data', 255)->nullable();
            $table->string('start_day', 255)->nullable();
            $table->string('end_day', 255)->nullable();
            $table->string('start_month', 255)->nullable();
            $table->string('end_month', 255)->nullable();
            $table->string('year', 255)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magazine_numbers');
    }
};/** 
start_day
end_day
start_month
end_month */