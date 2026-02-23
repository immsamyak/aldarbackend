<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('namespace');
            $table->string('key');
            $table->text('en')->nullable();
            $table->text('ne')->nullable();
            $table->timestamps();

            $table->unique(['namespace', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
