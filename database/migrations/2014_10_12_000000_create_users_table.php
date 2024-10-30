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
        $table->string('first_name');
        $table->string('last_name');
        $table->string('username')->unique();
        $table->string('email')->unique();
        $table->string('password');
        $table->date('birth_date');
        $table->string('job')->nullable();
        $table->string('country');
        $table->string('state');
        $table->string('city');
        $table->string('address1');
        $table->string('address2')->nullable();
        $table->string('zip_code')->nullable();
        $table->string('phone_number')->nullable();
        $table->boolean('email_verified')->default(false);
        $table->string('email_verification_token')->nullable();
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
