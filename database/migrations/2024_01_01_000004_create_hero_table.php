<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero', function (Blueprint $table) {
            $table->id();
            $table->string('headline_en');
            $table->string('headline_ne');
            $table->string('subheadline_en')->default('');
            $table->string('subheadline_ne')->default('');
            $table->enum('background_type', ['image', 'video'])->default('image');
            $table->string('background_url')->default('');
            $table->string('cta_primary_label_en')->default('');
            $table->string('cta_primary_label_ne')->default('');
            $table->string('cta_primary_link')->default('');
            $table->string('cta_secondary_label_en')->default('');
            $table->string('cta_secondary_label_ne')->default('');
            $table->string('cta_secondary_link')->default('');
            $table->boolean('show_counters')->default(true);
            $table->json('counters')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero');
    }
};
