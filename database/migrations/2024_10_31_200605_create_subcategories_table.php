<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_de');
            $table->string('name_tr');
            $table->string('name_ar');
            $table->string('name_fr');
            $table->string('name_zh');
            $table->text('description_en');
            $table->text('description_de');
            $table->text('description_tr');
            $table->text('description_ar');
            $table->text('description_fr');
            $table->text('description_zh');
            $table->string('image')->nullable();
            $table->json('images')->nullable(); 
            $table->string('pdf_file')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
    }
};
