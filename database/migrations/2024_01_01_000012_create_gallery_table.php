<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ne');
            $table->string('caption_en')->default('');
            $table->string('caption_ne')->default('');
            $table->string('media_url');
            $table->enum('media_type', ['image', 'video'])->default('image');
            $table->string('category')->default('general');
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery');
    }
};
