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
        Schema::create('telephone_sellers', function (Blueprint $table) {
               $table->id();
            $table->string('first_name',80);
            $table->string('last_name',80);
            $table->string("national_code")->nullable();
            $table->string('issue_place',80)->nullable();
            $table->date('birth_date')->nullable();
            $table->enum("married_status",['single','married']);
            $table->string('address',200)->nullable();
            $table->string("emergency_phone",11)->nullable();
            $table->string("any_teammate_family",250)->default("no");
            $table->string("extera_activity",250)->default("no");
            $table->string("health_status",250)->default("yes");
            $table->string("punishment_history",250)->default("no");
            $table->string("personel_code")->nullable();
            $table->string("password")->nullable();
            $table->string("educational_background")->nullable();
            $table->string("field_of_study")->nullable();
            $table->string("institution_name")->nullable();
            $table->string("Position")->nullable();
            $table->string("field_of_activity")->nullable();
            $table->string("image");
            $table->enum("status",['rejected','active','inactive','pennding'])
            ->default('pennding');
            $table->unsignedInteger("score")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telephone_sellers');
    }
};
