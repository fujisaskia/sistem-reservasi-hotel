<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactAndSocialMediaToHotelSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('hotel_settings', function (Blueprint $table) {
            $table->string('address')->nullable(); // Alamat
            $table->string('email')->nullable();   // Email
            $table->string('phone')->nullable();   // Nomor telepon
            $table->string('instagram')->nullable(); // Instagram
            $table->string('facebook')->nullable();  // Facebook
            $table->string('tiktok')->nullable();    // TikTok
            $table->string('whatsapp')->nullable();  // WhatsApp
        });
    }

    public function down()
    {
        Schema::table('hotel_settings', function (Blueprint $table) {
            $table->dropColumn(['address', 'email', 'phone', 'instagram', 'facebook', 'tiktok', 'whatsapp']);
        });
    }
}

