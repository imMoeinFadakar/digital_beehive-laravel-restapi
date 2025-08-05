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
        Schema::create('seller_users', function (Blueprint $table) {
            $table->id();

             $table->foreignId("user_id")
            ->constrained("users")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

             $table->foreignId("telephone_seller_id")
            ->constrained("telephone_sellers")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_users');
    }
};
