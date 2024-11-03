<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->string('site_title')->nullable();
            $table->string('home_page_title')->nullable();
            
            // Contact Information
            $table->string('whatsapp_number')->nullable();
            $table->string('store_email')->nullable();
            
            // Store Details
            $table->text('facebook_iframe')->nullable();
            $table->string('shop_address')->nullable();
            
            // SEO Settings
            $table->string('site_meta_keywords')->nullable();
            $table->text('site_meta_description')->nullable();
            
            // Marketing Settings
            $table->string('facebook_pixel')->nullable();
            $table->string('tag_manager')->nullable();
            $table->string('google_analytics')->nullable();
            $table->string('domain_verification')->nullable();
            
            // Social Links
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('twitter_url')->nullable();
            
            // Appearance & Stock Settings
            $table->string('primary_color')->nullable();
            $table->integer('stock_alert_quantity')->nullable();
            $table->decimal('delivery_charge_inside_dhaka', 10, 2)->nullable();
            $table->decimal('delivery_charge_outside_dhaka', 10, 2)->nullable();
            
            // Chat Bot Option
            $table->text('messenger_bot')->nullable();
            $table->text('whatsapp_bot')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
