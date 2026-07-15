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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('supplier_id');
            $table->bigInteger('category_id');
            $table->string('magazine_number', 150)->nullable();
            $table->string('name', 150);
            $table->text('description', 1000);
            $table->string('departament', 150);
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('resale_price', 10, 2);
            $table->string('percentage', 3);
            $table->string('photo_url', 255);
            $table->string('code', 50);
            $table->boolean('non_production')->default(false);
            $table->boolean('confirmed')->default(false);
            $table->integer('points');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};