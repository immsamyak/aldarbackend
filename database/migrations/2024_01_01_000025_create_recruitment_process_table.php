<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recruitment_process', function (Blueprint $table) {
            $table->id();
            $table->integer('step_number');
            $table->string('title_en');
            $table->string('title_ne')->default('');
            $table->text('description_en')->nullable();
            $table->text('description_ne')->nullable();
            $table->string('icon')->default('');
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recruitment_process');
    }
};
