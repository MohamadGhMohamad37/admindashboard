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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_de');
            $table->string('name_fr');
            $table->string('name_ar');
            $table->string('name_zh');
            $table->string('name_tr');
            $table->text('description_en');
            $table->text('description_de');
            $table->text('description_fr');
            $table->text('description_ar');
            $table->text('description_zh');
            $table->text('description_tr');
            $table->string('image');
            $table->json('images')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
