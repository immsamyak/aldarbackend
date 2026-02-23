<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_en');
            $table->string('title_ne');
            $table->longText('content_en')->nullable();
            $table->longText('content_ne')->nullable();
            $table->string('seo_title_en')->default('');
            $table->string('seo_title_ne')->default('');
            $table->text('seo_description_en')->nullable();
            $table->text('seo_description_ne')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cms_pages');
    }
};
