<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('tagline')->default('');
            $table->string('industry')->default('');
            $table->string('logo_url')->default('');
            $table->string('favicon_url')->default('');
            $table->string('office_address')->default('');
            $table->json('phone_numbers')->nullable();
            $table->json('emails')->nullable();
            $table->json('social_links')->nullable();
            $table->string('whatsapp_number')->default('');
            $table->text('whatsapp_message')->nullable();
            $table->boolean('whatsapp_enabled')->default(true);
            $table->text('chatbot_greeting')->nullable();
            $table->string('chairman_name')->default('');
            $table->string('chairman_photo_url')->default('');
            $table->text('chairman_message_en')->nullable();
            $table->text('chairman_message_ne')->nullable();
            $table->string('signature_url')->default('');
            $table->text('registration_info_en')->nullable();
            $table->text('registration_info_ne')->nullable();
            $table->text('footer_summary_en')->nullable();
            $table->text('footer_summary_ne')->nullable();
            $table->string('license_number')->default('');
            $table->string('registration_number')->default('');
            $table->string('pan_number')->default('');
            $table->string('capital_amount')->default('');
            $table->string('bank_name')->default('');
            $table->text('google_map_embed')->nullable();
            $table->text('about_us_en')->nullable();
            $table->text('about_us_ne')->nullable();
            $table->text('vision_en')->nullable();
            $table->text('vision_ne')->nullable();
            $table->text('mission_en')->nullable();
            $table->text('mission_ne')->nullable();
            $table->json('objectives_en')->nullable();
            $table->json('objectives_ne')->nullable();
            $table->string('primary_color')->default('#038441');
            $table->string('secondary_color')->default('#026B34');
            $table->string('accent_color')->default('#D4AF37');
            $table->string('light_bg_color')->default('#F0F7F2');
            $table->string('dark_footer_color')->default('#012A15');
            $table->text('registered_with_en')->nullable();
            $table->text('registered_with_ne')->nullable();
            $table->text('for_employers_intro_en')->nullable();
            $table->text('for_employers_intro_ne')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brand');
    }
};
