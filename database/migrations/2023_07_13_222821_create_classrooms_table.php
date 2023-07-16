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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id(); //BIGINT unsigned AUTO_INCREMENT PRIMARY KEY .
            $table->string('name', 255);
            $table->string('code', 10)->unique();
            $table->string('section')->nullable();
            $table->string('room')->nullable();
            $table->string('subject')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('theme')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['active', 'archived'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
