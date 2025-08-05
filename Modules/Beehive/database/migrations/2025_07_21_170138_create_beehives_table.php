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
        Schema::create('beehives', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
            ->unique()
            ->constrained("users")
            ->onDelete('cascade'); 

            $table->unsignedBigInteger("power")->default(1);
            $table->unsignedBigInteger("bee_quentity")->default(1);
            $table->unsignedBigInteger("frame_quentity")->default(1);
            $table->unsignedBigInteger("honey_amount")->default(0);
            $table->enum("status",['active','inactive'])
            ->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beehives');
    }
};
