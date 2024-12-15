<!-- resources/views/home.blade.php -->
@extends('layouts/receptionist')

@section('title', 'Create Reservation')

@section('content')

<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg text-sm md:text-xs">
    <form action="">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- guest name --}}
            <div class="space-y-2">
                <div class="">
                    <label for="name" class="text-[11px] text-gray-600">Pilih Akun tamu</label>
                    <div class="flex space-x-2">
                        <input type="text" id="name" name="name" class="flex-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-rose-500 focus:border-rose-500" placeholder="nama tamu" required>
                        <a href="">
                            <button class="border-2 border-blue-500 px-3 py-2 rounded-md">
                                buat akun
                            </button>
                        </a>
                    </div>                </div>
                <div class="">
                    <label for="name" class="text-[11px] text-gray-600">Email Tamu</label>
                    <input type="email" id="name" name="name" class="flex-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-rose-500 focus:border-rose-500" placeholder="email tamu" required>
                </div>
            </div>
    
            {{-- kolom input check-in / Out --}}
            <div class="">
                <div class="flex items-center p-2 mb-4 text-yellow-800 rounded-lg bg-yellow-50 text-[11px]" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                    <span class="font-medium">Masukkan tanggal check-in & check-out di bawah ini!</span>
                    </div>
                </div>
                <div class="space-x-3 flex pb-4 border-b">
                    {{-- input tanggal check-in --}}
                    <div>
                        <input type="text" id="check-in" name="check_in_date" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-rose-500 focus:border-rose-500" placeholder="Pilih check-in date">
                    </div>
                    {{-- input tanggal check-out --}}
                    <div>
                        <input type="text" id="check-out" name="check_out_date" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-rose-500 focus:border-rose-500" placeholder="Pilih check-out date">
                    </div>
                    {{-- button untuk mengecek tanggal dan menampilkan tipe kamar yang tersedia --}}
                    <div class="">
                        <button id="check-button" type="button" class="bg-rose-600 hover:bg-rose-700 rounded-md px-4 py-2 text-white">Check</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Tabel Daftar Kamar Tersedia-->
        <div id="room-table" class=" hidden py-4">
            <div class="flex items-center p-2 mb-4 text-yellow-800 rounded-lg bg-yellow-50 text-[11px]" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                <span class="font-medium">Harga di sini telah dihitung dengan jumlah malam</span>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gray-200">
                        <tr class="text-left">
                            <th class="px-4 py-2 border-b text-center">No</th>
                            <th class="px-4 py-2 border-b">Tipe Kamar</th>
                            <th class="px-4 py-2 border-b">Kapasitas</th>
                            <th class="px-4 py-2 border-b">Harga</th>
                            <th class="px-4 py-2 border-b">Quantity</th>
                            <th class="px-4 py-2 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody  class="text-left">
                        {{-- tipe kamar yang muncul adalah tipe kamar yang statusnya tersedia --}}
                        {{-- @foreach ($roomTypes as $index => $type)
                        <tr class="text-left hover:bg-gray-50">
                            <td class="px-4 py-2 border-b text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border-b">{{ $type->tipe_kamar }}</td>
                            <td class="px-4 py-2 border-b">{{ $type->kapasitas }} Adult(s)</td> --}}
                            {{-- harga ini akan berubah sesuai jumlah malam ditanggal check-in & check-out --}}
                            {{-- <td class="px-4 py-2 border-b">IDR 
                                <span class="room-price" data-price="{{ $type->harga }}">
                                    {{ number_format($type->harga, 0, ',', ',') }}
                                </span>
                            </td> --}}
                            {{-- <td class="px-4 py-2 border-b">
                                <div class="relative flex items-center">
                                    <button type="button" id="decrement-button" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 p-1 rounded focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                        <svg class="w-2 h-2 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                        </svg>
                                    </button>
                                    <input type="text" id="quantity-input" class="bg-gray-50 border-x-0 border-gray-300 text-center text-gray-900 focus:ring-blue-500 focus:border-blue-500 block w-12 p-1 text-sm" value="1" />
                                    <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 p-1 rounded focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                        <svg class="w-2 h-2 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td> --}}
                            {{-- <td class="px-4 py-2 border-b"> --}}
                                {{-- div untuk memilih tipe kamar --}}
                                {{-- <div class="flex space-x-1 bg-rose-500 hover:bg-rose-700 p-1 text-white rounded items-center justify-center text-center">
                                    <i class="fa-solid fa-tags"></i>
                                    <span>Booking</span>
                                </div> --}}
                                {{-- ketika tipe kamar telah dipilih maka akan berubah warna --}}
                                {{-- <div class="flex space-x-1 bg-yellow-500 hover:bg-yellow-600 p-1 text-white rounded items-center justify-center text-center">
                                    <i class="fa-solid fa-hashtag"></i>
                                    <span>Booking</span>
                                </div> --}}
                            {{-- </td>
                        </tr>
                        @endforeach
                    </tbody> --}}
                </table>
            </div>
        </div>

        {{-- select pembayaran --}}
        {{-- <div class="md:flex space-y-3 justify-around py-3 border-y">
            <div class="flex space-x-3 items-center">
                <i class="fa-solid fa-dollar-sign"></i>
                <label for="payment_status" class="font-semibold">Payment Status :</label>
                <select name="payment_status" id="payment_status" class="px-6 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-rose-500 focus:border-rose-500">
                    <option value="Paid">Paid</option>
                    <option value="Unpaid">Unpaid</option>
                </select>        
            </div> --}}
            {{-- select status reservasi --}}
            {{-- <div class="flex space-x-3 items-center">
                <i class="fa-solid fa-tags"></i>
                <label for="reservation_status" class="font-semibold">Status Reservasi:</label>
                <select name="reservation_status" id="reservation_status" class="px-6 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-rose-500 focus:border-rose-500">
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Checked-In">Checked-In</option>
                    <option value="Checked-Out">Checked-Out</option>
                    <option value="Checked-Out">Cancelled</option>
                </select>        
            </div>
        </div> --}}

        {{-- button untuk membuat reservasi --}}
        <button type="submit" class="py-2 px-4 bg-green-500 hover:bg-green-600 rounded-md text-white mt-5">Buat</button>
    </form>
    
</div>

<script>
    flatpickr("#check-in", {
        minDate: "today",  // Past dates cannot be selected
        dateFormat: "d M Y",  // Format date
    });

    flatpickr("#check-out", {
        minDate: "today",  // Past dates cannot be selected
        dateFormat: "d M Y",  // Format date
    });

    
    document.getElementById('check-button').addEventListener('click', function() {
        const checkInDate = document.getElementById('check-in').value;
        const checkOutDate = document.getElementById('check-out').value;

        // Pastikan input tidak kosong
        if (!checkInDate || !checkOutDate) {
            alert("Harap masukkan tanggal check-in dan check-out!");
            return;
        }

        // Hitung jumlah malam
        const startDate = new Date(checkInDate);
        const endDate = new Date(checkOutDate);
        const diffTime = Math.abs(endDate - startDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        // Validasi jumlah malam
        if (diffDays <= 0) {
            alert("Tanggal check-out harus setelah tanggal check-in!");
            return;
        }

        // Tampilkan tabel
        document.getElementById('room-table').classList.remove('hidden');

        // Perbarui harga kamar
        const roomPrices = document.querySelectorAll('.room-price');
        roomPrices.forEach(priceElement => {
            const originalPrice = parseInt(priceElement.dataset.price, 10);
            const updatedPrice = originalPrice * diffDays;

            // Tampilkan harga yang diperbarui
            priceElement.textContent = updatedPrice.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
        });
    });

</script>


@endsection