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
        Schema::create('customer_based_verifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('avata_user')->nullable();
            $table->string('situation', 200);
            $table->string('name', 200);
            $table->string('email', 200);
            $table->string('cpf', 14);
            $table->boolean('confirmed')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_based_verifications');
    }
};