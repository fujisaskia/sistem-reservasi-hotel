<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{
    public function run()
    {
        // Menambahkan kategori 'Makanan' dan 'Minuman'
        ServiceCategory::create([
            'name' => 'Makanan',
            'description' => 'Kategori yang berisi berbagai macam jenis makanan.'
        ]);

        ServiceCategory::create([
            'name' => 'Minuman',
            'description' => 'Kategori yang berisi berbagai macam jenis minuman.'
        ]);
    }
}

