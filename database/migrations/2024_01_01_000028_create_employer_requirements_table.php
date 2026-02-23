<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employer_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('document_name_en');
            $table->string('document_name_ne')->default('');
            $table->text('description_en')->nullable();
            $table->text('description_ne')->nullable();
            $table->boolean('is_required')->default(true);
            $table->string('category')->default('general');
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employer_requirements');
    }
};
