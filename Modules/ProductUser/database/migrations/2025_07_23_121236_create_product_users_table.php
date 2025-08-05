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
        Schema::create('product_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
            ->constrained("users")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

             $table->foreignId("product_id")
            ->constrained("products")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            //  $table->foreignId("product_code_id")
            //  ->unique()
            // ->constrained("product_codes")
            // ->cascadeOnDelete()
            // ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_users');
    }
};
