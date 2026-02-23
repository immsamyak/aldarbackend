<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['interview', 'result', 'documentation', 'general'])->default('general');
            $table->string('title_en');
            $table->string('title_ne');
            $table->text('description_en')->nullable();
            $table->text('description_ne')->nullable();
            $table->string('attachment_url')->default('');
            $table->string('image_url')->default('');
            $table->string('pdf_url')->default('');
            $table->timestamp('publish_date')->useCurrent();
            $table->boolean('is_published')->default(true);
            $table->boolean('is_popup')->default(false);
            $table->timestamp('schedule_date')->nullable();
            $table->json('target_pages')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
