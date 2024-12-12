<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role-role sudah ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $receptionistRole = Role::firstOrCreate(['name' => 'receptionist']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Buat user admin
        $admin = User::create([
            'full_name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        $admin->assignRole($adminRole);

        // Buat user receptionist
        $receptionist = User::create([
            'full_name' => 'Receptionist',
            'email' => 'receptionist@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'receptionist',
        ]);
        $receptionist->assignRole($receptionistRole);

        // Buat user biasa
        $user = User::create([
            'title' => 'Ms.',
            'full_name' => 'User Example',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone_number' => '0812345678',
            'nationality' => 'Indonesia',
        ]);
        $user->assignRole($userRole);
    }
}
