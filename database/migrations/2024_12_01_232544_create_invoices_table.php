<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('invoice_id'); // Primary key
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
            $table->string('invoice_number')->unique(); // Nomor invoice unik
            $table->decimal('total_amount', 10, 2); // Total pembayaran
            $table->date('invoice_date'); // Tanggal invoice dibuat
            $table->date('due_date'); // Tanggal jatuh tempo pembayaran
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
        Schema::dropIfExists('invoices');
    }
}
