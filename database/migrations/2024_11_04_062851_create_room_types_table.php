<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypesTable extends Migration
{
    public function up()
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_kamar'); // Nama tipe kamar
            $table->integer('kapasitas'); // Kapasitas maksimum
            $table->decimal('harga', 10, 2); // Harga per malam
            $table->text('deskripsi_kamar'); // Deskripsi kamar
            $table->text('fasilitas'); // Fasilitas kamar
            $table->json('foto'); // Menyimpan lebih dari 3 foto dalam format JSON
            $table->timestamps(); // Menyimpan informasi waktu dibuat dan diperbarui
        });
    }

    public function down()
    {
        Schema::dropIfExists('room_types');
    }
}

