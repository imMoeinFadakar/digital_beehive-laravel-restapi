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
        Schema::create('reward_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
            ->constrained("users")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

             $table->foreignId("reward_id")
            ->constrained("rewards")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->enum("status",['done','pennding'])->default('pennding');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_users');
    }
};
