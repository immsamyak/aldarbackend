<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chatbot_data', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['jobs', 'notices', 'office', 'visa_faqs']);
            $table->text('question_en');
            $table->text('question_ne');
            $table->text('answer_en');
            $table->text('answer_ne');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chatbot_data');
    }
};
