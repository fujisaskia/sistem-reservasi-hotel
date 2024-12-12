<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai primary key
            $table->string('name'); // Kolom untuk nama kategori layanan
            $table->text('description'); // Kolom untuk deskripsi kategori layanan
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_categories');
    }
}

