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
            $table->string('name_en');
            $table->string('name_de');
            $table->string('name_fr');
            $table->string('name_ar');
            $table->string('name_tr');
            $table->string('name_zh');
            $table->text('description_en')->nullable();
            $table->text('description_de')->nullable();
            $table->text('description_fr')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_tr')->nullable();
            $table->text('description_zh')->nullable();
            $table->string('main_image')->nullable();
            $table->json('gallery_images')->nullable(); // لتخزين مجموعة الصور كـ JSON
            $table->string('video')->nullable();
            $table->string('pdf_file')->nullable();
            $table->foreignId('sub_category_id')->constrained()->onDelete('cascade');
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
