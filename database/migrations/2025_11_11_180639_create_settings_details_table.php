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
        Schema::create('settings_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullble();
            $table->bigInteger('cor_id')->nullble();
            $table->string('pix', 255)->nullable();
            $table->string('percentage', 3)->nullable();
            $table->integer('installment_number')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('minimum_price_for_installment', 10, 2)->nullable();
            $table->string('text_color_site', 150)->nullable();        
            $table->string('color_site_bg', 150)->nullable();
            $table->string('bg_color_site', 150)->nullable();
            $table->string('bg_color_menu_vertical', 150)->nullable();
            $table->string('color_menu_vertical_text', 150)->nullable();
            $table->string('bg_color_menu_horisontal', 150)->nullable();
            $table->string('color_menu_horisontal_text', 150)->nullable();
            $table->string('bg_color_table', 150)->nullable();
            $table->string('color_table_text', 150)->nullable();
            $table->string('color_card_bg', 150)->nullable();
            $table->string('color_card_text', 150)->nullable();
            $table->string('text_color', 50)->nullable();
            $table->string('color_border', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings_details');
    }
};