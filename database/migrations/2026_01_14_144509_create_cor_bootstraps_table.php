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
        Schema::create('cor_bootstraps', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150)->nullable();
            $table->string('color_bg', 150)->nullable();
            $table->string('color_table_bg', 150)->nullable();
            $table->string('color_card_bg', 150)->nullable();
            $table->string('color_text', 150)->nullable();
            $table->string('color_border', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cor_bootstraps');
    }
};