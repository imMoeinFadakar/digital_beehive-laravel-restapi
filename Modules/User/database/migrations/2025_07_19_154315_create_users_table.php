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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',80)->nullable();
            $table->string('last_name',80)->nullable();
            $table->string('email',80)->nullable()->unique();
            $table->string('phone_number',11)->nullable();
            $table->string("address",100)->nullable();
            $table->unsignedBigInteger("postal_code")->nullable();
            $table->string("image")->nullable();
            $table->string('password');
            $table->timestamp('phone_verified_at')->nullable();
            $table->enum('status',['active',"inactive"])->default('active');
            $table->enum('role',['customer','admin'])->default('customer');
            $table->unsignedInteger('score')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
