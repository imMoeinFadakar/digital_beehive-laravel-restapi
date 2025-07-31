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
        Schema::create('seller_products', function (Blueprint $table) {
            $table->id();

            $table->foreignId("seller_id")
            ->constrained("sellers")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

             $table->foreignId("product_code_id")
            ->constrained("product_codes")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->unsignedBigInteger("commission");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_products');
    }
};
