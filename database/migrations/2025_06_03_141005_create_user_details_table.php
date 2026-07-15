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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('zip_code', 10);
            $table->string('address', 255);
            $table->string('number', 11);
            $table->string('complement', 50)->nullable();
            $table->string('neighborhood', 150);
            $table->string('city', 50);
            $table->string('phone', 20);
            $table->decimal('salary', 10, 2);
            $table->date('admission_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};