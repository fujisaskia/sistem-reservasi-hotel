<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_hotel_settings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('hotel_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('logo_path')->nullable(); // Menyimpan path logo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotel_settings');
    }
}
