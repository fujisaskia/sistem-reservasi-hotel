<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('service_orders', function (Blueprint $table) {
            // Hapus kolom yang tidak diperlukan
            $table->dropColumn(['quantity', 'order_date', 'notes']);
            
            // Tambahkan kolom status_order
            $table->string('status_order')->default('unpaid')->after('total_price');
        });
    }
    
    public function down()
    {
        Schema::table('service_orders', function (Blueprint $table) {
            // Tambahkan kembali kolom yang dihapus
            $table->integer('quantity');
            $table->timestamp('order_date')->useCurrent();
            $table->text('notes')->nullable();
            
            // Hapus kolom status_order jika rollback
            $table->dropColumn('status_order');
        });
    }
    
    
};
