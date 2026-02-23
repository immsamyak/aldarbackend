<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('code')->default('');
            $table->string('flag_url')->default('');
            $table->string('name_en');
            $table->string('name_ne');
            $table->text('visa_info_en')->nullable();
            $table->text('visa_info_ne')->nullable();
            $table->json('demand_sectors_en')->nullable();
            $table->json('demand_sectors_ne')->nullable();
            $table->string('salary_range_en')->default('');
            $table->string('salary_range_ne')->default('');
            $table->text('requirements_en')->nullable();
            $table->text('requirements_ne')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
