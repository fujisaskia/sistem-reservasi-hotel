<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_hotel_photos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelPhotosTable extends Migration
{
    public function up()
    {
        Schema::create('hotel_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_setting_id')->constrained('hotel_settings');
            $table->string('photo_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotel_photos');
    }
}

