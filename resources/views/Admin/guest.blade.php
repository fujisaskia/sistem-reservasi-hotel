<!-- resources/views/home.blade.php -->
@extends('layouts/admin')

@section('title', 'Tamu')

@section('content')

<div class="container bg-white py-8 px-4 rounded-lg lg:mr-12">
    <h2 class="text-2xl font-bold text-center mb-4">Tamu</h2>
    <div class="flex justify-center items-center mb-6 text-xs">
        <div class="w-full max-w-md">
            <form class="flex items-center">
                <input type="search" id="default-search" class="w-full p-3 lg:p-2 rounded-full border border-gray-300 focus:outline-none focus:ring focus:ring-yellow-100" placeholder="Nama Tamu ...">
                <button type="submit" class="bg-rose-500 text-white py-4 lg:py-3 px-4 rounded-full hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-rose-500">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-rose-100">
                    <th class="py-3 px-4 border-b border-gray-200 text-left text-sm lg:text-xs font-semibold text-gray-600">No</th>
                    <th class="py-3 px-4 border-b border-gray-200 text-left text-sm lg:text-xs font-semibold text-gray-600">Nama Tamu</th>
                    <th class="py-3 px-4 border-b border-gray-200 text-left text-sm lg:text-xs font-semibold text-gray-600">Tipe Kamar</th>
                    <th class="py-3 px-4 border-b border-gray-200 text-left text-sm lg:text-xs font-semibold text-gray-600">Kamar</th>
                    <th class="py-3 px-4 border-b border-gray-200 text-left text-sm lg:text-xs font-semibold text-gray-600">Email</th>
                    <th class="py-3 px-4 border-b border-gray-200 text-left text-sm lg:text-xs font-semibold text-gray-600">No. Telp / Handphone</th>
                    <th class="py-3 px-4 border-b border-gray-200 text-left text-sm lg:text-xs font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $index => $reservation)
                <tr class="hover:bg-gray-100">
                    <td class="py-3 px-4 border-b border-gray-200 text-sm lg:text-xs text-gray-600">{{ $index + 1 }}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-sm lg:text-xs text-gray-600">{{ $reservation->user->full_name }}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-sm lg:text-xs text-gray-600">{{ $reservation->roomType->tipe_kamar }}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-sm lg:text-xs text-gray-600">{{ $reservation->room->room_number }}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-sm lg:text-xs text-gray-600">{{ $reservation->user->email }}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-sm lg:text-xs text-gray-600">{{ $reservation->user->phone_number }}</td>
                    <td class="py-2 px-3 border-b border-gray-200 text-sm lg:text-xs">
                        <div class="flex space-x-2 justify-center">
                            <a href="{{ route('lihat-layanan', $reservation->id) }}">
                                <button class="flex space-x-2  items-center justify-center bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md shadow-lg hover:shadow-none">
                                    <i class="fa-regular fa-eye"></i>
                                    <span class="text-[10px]">Lihat Layanan</span>
                                </button>                                
                            </a>                            
                        </div>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-3 px-4 text-center text-gray-600">No data available</td>
                    </tr>
                @endforelse
 
                <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
            </tbody>
        </table>
    </div>
</div>



@endsection
    
