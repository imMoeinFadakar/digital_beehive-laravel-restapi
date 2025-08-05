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
        Schema::create('refferals', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('reffered_id')
            ->unique()
            ->constrained("users")
            ->onDelete('cascade'); 

            
            $table->foreignId('reffering_id')
            ->constrained("users")
            ->onDelete('cascade'); 
            
          $table->boolean("has_user_reward")->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refferals');
    }
};
