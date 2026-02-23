<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_en');
            $table->string('title_ne');
            $table->text('description_en');
            $table->text('description_ne');
            $table->string('category');
            $table->string('country');
            $table->integer('salary_min')->default(0);
            $table->integer('salary_max')->default(0);
            $table->string('currency')->default('USD');
            $table->text('requirements_en')->nullable();
            $table->text('requirements_ne')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['open', 'closed', 'draft'])->default('open');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
