<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legal_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ne')->default('');
            $table->text('description_en')->nullable();
            $table->text('description_ne')->nullable();
            $table->string('document_url')->default('');
            $table->string('document_type')->default('license');
            $table->string('issue_authority_en')->default('');
            $table->string('issue_authority_ne')->default('');
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('reference_number')->default('');
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legal_documents');
    }
};
