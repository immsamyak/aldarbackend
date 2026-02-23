<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ne')->default('');
            $table->string('slug')->default('');
            $table->text('description_en')->nullable();
            $table->text('description_ne')->nullable();
            $table->string('icon')->default('');
            $table->string('image_url')->default('');
            $table->string('sector_type')->default('general');
            $table->json('positions')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
