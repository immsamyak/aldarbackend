<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organization_structure', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation_en');
            $table->string('designation_ne')->default('');
            $table->string('photo_url')->default('');
            $table->text('bio_en')->nullable();
            $table->text('bio_ne')->nullable();
            $table->string('department')->default('');
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_structure');
    }
};
