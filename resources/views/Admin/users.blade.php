<!-- resources/views/home.blade.php -->
@extends('layouts/admin')

@section('title', 'Guest | Admin')

@section('content')

<div class="max-w-4xl mx-auto bg-white py-8 px-6 rounded-lg">
    <h2 class="text-2xl pb-6 font-bold text-center mb-4 border-b">Users</h2>

    <a href="/add-guest">
        <button class="flex space-x-2 text-white bg-green-500 hover:bg-green-600 focus:bg-green-500 text-sm lg:text-xs px-4 py-3 lg:py-2 rounded-lg my-6">
            <i class="fa-solid fa-user-plus"></i>
            <p>Tambah User</p>
        </button>
    </a>
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-rose-100">
                    <th class="py-3 px-4 border-b border-gray-200 text-left text-sm lg:text-xs font-semibold text-gray-600">No</th>
                    <th class="py-3 px-4 border-b border-gray-200 text-left text-sm lg:text-xs font-semibold text-gray-600">Nama</th>
                    <th class="py-3 px-4 border-b border-gray-200 text-left text-sm lg:text-xs font-semibold text-gray-600">Role</th>
                    <th class="py-3 px-4 border-b border-gray-200 text-center text-sm lg:text-xs font-semibold text-gray-600">Aksi</th>

                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-100 group">
                    <td class="py-3 px-4 border-b border-gray-200 text-sm lg:text-xs text-gray-600">1</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-sm lg:text-xs text-gray-600">John Doe</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-sm lg:text-xs text-gray-600 bg-slate-50 group-hover:bg-white">Resepsionis</td>

                    <td class="py-2 px-3 border-b border-gray-200 text-sm lg:text-xs">
                        <div class="flex space-x-2 justify-center">
                            <a href="" class="flex space-x-2 items-center justify-center bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded-md shadow-lg hover:shadow-none">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            
                            <a href="" class="lg:flex space-x-2 items-center justify-center bg-orange-500 hover:bg-orange-600 text-white py-1 px-2 rounded-md shadow-lg hover:shadow-none">
                                <i class="fa-solid fa-pen-nib"></i>
                            </a>

                            <a href="" class="lg:flex space-x-2 items-center justify-center bg-red-500 hover:bg-red-600 text-white p-2 rounded-md shadow-lg hover:shadow-none">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                    </td>
                </tr>
 
 
                <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
            </tbody>
        </table>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
{{-- form tambah user --}}
<div class="max-w-md mx-auto p-6 bg-white shadow-md rounded-md">
    <h2 class="text-lg pb-3 border-b font-semibold text-gray-800 mb-4 text-center">Tambah User</h2>
    
    <!-- Form Tambah User -->
    <form class="text-xs">
        <!-- Nama -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 mb-2">Nama</label>
            <input type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-300" placeholder="Masukkan nama" required>
        </div>

        <!-- Role -->
        <div class="mb-4">
            <label for="role" class="block text-gray-700 mb-2">Role</label>
            <select id="role" name="role" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-300" required>
                <option value="user">User</option>
                <option value="resepsionis">Resepsionis</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <!-- Password -->
        <div class="mb-6">
            <label for="password" class="block text-gray-700 mb-2">Password</label>
            <input type="password" id="password" name="password" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-300" placeholder="Masukkan password" required>
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end space-x-2">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Tambah User
            </button>
            <button type="submit" class="bg-orange-400 text-white px-4 py-2 rounded hover:bg-orange-500">
                batal
            </button>
        </div>
    </form>
</div>




@endsection
    
