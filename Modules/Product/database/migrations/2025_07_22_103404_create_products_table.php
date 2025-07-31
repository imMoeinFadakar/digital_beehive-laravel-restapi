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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
            ->constrained("categories")
            ->onDelete('cascade'); 
            $table->string('name',80);
            $table->string('slug',80);
            $table->string('image');
            $table->string('banner_image');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('last_price');
            $table->enum("unite",['kilogram','quentity']);
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
