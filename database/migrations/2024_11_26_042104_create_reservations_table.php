<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_type_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 12, 2);  // Menyimpan harga untuk total biaya reservasi
            $table->integer('total_guest'); // Jumlah tamu
            $table->integer('total_room'); // Jumlah kamar yang dipesan
            $table->date('reservation_date');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->enum('reservation_status', ['Pending', 'Confirmed', 'Checked-In', 'Checked-Out', 'Cancelled']);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};