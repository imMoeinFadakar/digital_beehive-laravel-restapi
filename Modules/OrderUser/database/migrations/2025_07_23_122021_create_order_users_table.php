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
        Schema::create('order_users', function (Blueprint $table) {
            $table->id();
             $table->foreignId("user_id")
            ->constrained("users")
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('product_id')
            ->constrained("products")
            ->onDelete('cascade'); 

            $table->unsignedInteger('quentity')->default(1);

            $table->string("transaction_number",50)->default("pay_at_home");
            $table->enum("status",['in_proccess','done','canceled']);
            $table->enum("payment_method",['pay_at_home','online','card_to_card']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_users');
    }
};
