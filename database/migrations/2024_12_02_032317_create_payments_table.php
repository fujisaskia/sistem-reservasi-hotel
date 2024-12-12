<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade'); // Relasi ke tabel reservations            
            $table->string('order_id')->unique(); // ID unik dari Midtrans
            $table->decimal('amount', 15, 2); // Jumlah yang dibayarkan
            $table->enum('payment_status', ['pending', 'success', 'failed'])->default('pending'); // Status pembayaran
            $table->string('payment_method'); // Tipe pembayaran (credit_card, bank_transfer, dll.)
            $table->timestamp('payment_date')->nullable(); // Waktu pembayaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
