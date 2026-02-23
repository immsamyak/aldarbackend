<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('label_en');
            $table->string('label_ne');
            $table->string('url')->default('');
            $table->integer('order_index')->default(0);
            $table->boolean('is_enabled')->default(true);
            $table->boolean('is_external')->default(false);
            $table->enum('target', ['_self', '_blank'])->default('_self');
            $table->enum('location', ['navbar', 'footer'])->default('navbar');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
