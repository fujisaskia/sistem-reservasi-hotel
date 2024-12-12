<?php

// database/migrations/xxxx_xx_xx_create_services_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nama layanan
            $table->foreignId('service_category_id')  // Relasi ke service_categories
                  ->constrained('service_categories') // Menghubungkan ke tabel service_categories
                  ->onDelete('cascade'); // Jika kategori dihapus, layanan terkait akan dihapus juga
            $table->decimal('price', 10, 2);  // Harga layanan
            $table->timestamps();  // Timestamp untuk created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}

