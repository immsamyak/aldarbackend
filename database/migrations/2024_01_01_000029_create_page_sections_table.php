<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug');
            $table->string('section_key');
            $table->string('section_type')->default('text'); // text, cards, steps, details, team_quotes
            $table->string('title_en')->nullable();
            $table->string('title_ne')->nullable();
            $table->string('subtitle_en')->nullable();
            $table->string('subtitle_ne')->nullable();
            $table->longText('content_en')->nullable();
            $table->longText('content_ne')->nullable();
            $table->json('items')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['page_slug', 'section_key']);
            $table->index('page_slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
