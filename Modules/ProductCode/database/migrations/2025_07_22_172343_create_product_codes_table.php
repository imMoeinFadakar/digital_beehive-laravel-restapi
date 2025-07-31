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
        Schema::create('product_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
            ->constrained("products")
            ->onDelete('cascade'); 

            $table->unsignedBigInteger('code');
            $table->unsignedInteger('score');
            $table->unsignedBigInteger("commission");
            $table->enum("status",['not_used','used']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_codes');
    }
};
