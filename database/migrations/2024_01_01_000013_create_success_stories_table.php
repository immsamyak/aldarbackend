<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('success_stories', function (Blueprint $table) {
            $table->id();
            $table->string('candidate_name');
            $table->string('photo_url')->default('');
            $table->string('country_deployed')->default('');
            $table->string('job_title_en')->default('');
            $table->string('job_title_ne')->default('');
            $table->text('story_en');
            $table->text('story_ne');
            $table->date('deployed_date')->nullable();
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('success_stories');
    }
};
