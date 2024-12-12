<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        // Ambil beberapa kategori layanan dari tabel service_categories
        $makananCategory = ServiceCategory::where('name', 'Makanan')->first();
        $minumanCategory = ServiceCategory::where('name', 'Minuman')->first();

        // Menambahkan layanan untuk kategori Food
        Service::create([
            'name' => 'Pasta',
            'service_category_id' => $makananCategory->id,
            'price' => 100.00,
        ]);

        // Menambahkan layanan untuk kategori Drink
        Service::create([
            'name' => 'Soda',
            'service_category_id' => $minumanCategory->id,
            'price' => 10.00,
        ]);
    }
}
