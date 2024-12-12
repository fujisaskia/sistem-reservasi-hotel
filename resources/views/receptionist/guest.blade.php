<!-- resources/views/home.blade.php -->
@extends('layouts/receptionist')

@section('title', 'check-in | receptionist')

@section('content')

<div class="container bg-white py-8 px-4 rounded-lg lg:mr-12">
    <h2 class="text-2xl font-bold text-center mb-4">Tamu</h2>
    <div class="flex justify-center items-center mb-6 text-xs">
        <div class="w-full max-w-md">
            <form class="flex items-center">
                <input type="search" id="default-search" class="w-full p-3 lg:p-2 rounded-l-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-rose-500" placeholder="Nama Tamu ...">
                <button type="submit" class="bg-rose-500 text-white py-4 lg:py-3 px-4 rounded-r-lg hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-rose-500">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>

    {{-- <a href="/add-guest">
        <button class="flex space-x-2 text-white bg-green-500 hover:bg-green-600 focus:bg-green-500 text-sm lg:text-xs px-4 py-3 lg:py-2 rounded-lg mb-3 ">
            <i class="fa-solid fa-user-plus"></i>
            <p>Tambah Tamu</p>
        </button>
    </a> --}}
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-rose-100">
                    <th class="py-3 px-4 border-b border-gray-200 text-left text-sm lg:text-xs font-semibold text-gray-600">No</th>
                    <th class="py-3 px-4 border-b border-gray-200 text-left text-sm lg:text-xs font-semibold text-gray-600">Nama Tamu</th>
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
                    <td class="py-3 px-4 border-b border-gray-200 text-sm lg:text-xs text-gray-600">{{ $reservation->room->room_number }}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-sm lg:text-xs text-gray-600">{{ $reservation->user->email }}</td>
                    <td class="py-3 px-4 border-b border-gray-200 text-sm lg:text-xs text-gray-600">{{ $reservation->user->phone_number }}</td>
                    <td class="py-2 px-3 border-b border-gray-200 text-sm lg:text-xs">
                        <div class="flex space-x-2 justify-center">
                            <a href="{{ route('detail-layanan', $reservation->id) }}">
                                @include('components.button-read')
                            </a>                            
                            
                            <a href="{{ route('layanan.form', $reservation->id) }}" 
                                class="flex space-x-2 items-center justify-center bg-rose-500 hover:bg-rose-600 text-white py-1 px-2 rounded-md shadow-lg hover:shadow-none">
                                 <i class="fa-solid fa-bell-concierge"></i>
                                 <p class="text-[10px]">Layanan</p>
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
    
