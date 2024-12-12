<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        Role::firstOrCreate([
            'name' => 'receptionist',
            'guard_name' => 'web'
        ]);
        Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web'
        ]);

        // // Menambahkan role ke user
        // $user = User::find(1); // Misalnya user dengan ID 1
        // $user->assignRole('admin'); // Mengatur role admin ke user tersebut
    }
}
