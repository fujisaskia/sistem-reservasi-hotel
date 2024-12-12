@extends('layouts/receptionist')

@section('title', 'Tambah Tamu | Hotel')

@section('content')


<div class="container mx-auto p-6 bg-white shadow-lg rounded-lg text-xs">
    <h2 class="text-lg font-semibold mb-4">KAMAR NOMOR : 101</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- grid 1 --}}
        <div class="space-y-4">
            <!-- Invoice -->
            <div class="col-span-1">
                <label for="invoice" class="block text-sm font-semibold text-gray-700"># INVOICE</label>
                <input type="text" id="invoice" value="INV-20220522-63" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300">
            </div>

            <!-- Detail Kamar -->
            <div class="col-span-1 bg-rose-100 p-4 rounded-md">
                <h3 class="text-lg font-bold text-rose-600 mb-2">EXECUTIVE</h3>
                <div class="leading-relaxed">
                    <p>Harga / Malam : <span class="font-bold">Rp 2,000,000</span></p>
                    <p>Max. Dewasa : <span class="font-bold">2 Orang</span></p>
                    <p>Max. Anak-anak : <span class="font-bold">2 Orang</span></p>                        
                </div>
            </div>
            <select id="nama-tamu" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                <option>--Kategori Kamar--</option>
                <option>Room Only</option>
                <option>Include Breakfast</option>
            </select>
        </div>

        {{-- grid 2 --}}
        <div class="space-y-3">
            <div class="mb-2">
                <label for="nama-tamu" class="block text-sm lg:text-xs font-semibold text-gray-700">Nama Tamu</label>
                <div class="flex space-x-1">
                    <select id="salutation" class="mt-1 w-40 block p-3 lg:p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300">
                        <option>Mr</option>
                        <option>Mrs</option>
                    </select>

                    <label for="name" class="block font-medium text-gray-700"></label>
                    <input type="text" id="first-name" placeholder="masukkan nama tamu" class="mt-1 block w-full p-3 lg:p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300" required>
                </div> 
            </div>
            {{-- email --}}
            <div>
                <label for="email" class="block font-semibold text-gray-700">Email</label>
                <input type="email" id="email" placeholder="masukkan email tamu" class="mt-1 block w-full p-3 lg:p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300" required>
            </div>

            {{-- no.telp --}}
            <div>
                <label for="phone" class="block font-semibold text-gray-700">Nomor Telp / Handphone</label>
                <input type="number" id="phone" placeholder="masukkan no.telp tamu" class="mt-1 block w-full p-3 lg:p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300" required>
            </div>            <div class="">
                <div class="flex space-x-1">                      
                    <select id="salutation" class="w-40 block p-2 border border-gray-300 rounded-lg uppercase focus:outline-none focus:ring-2 focus:ring-yellow-300">
                        <option>wna</option>
                        <option>wni</option>
                    </select>

                    {{-- nomor idetitas --}}
                    <select id="salutation" class="w-40 block p-2 border border-gray-300 rounded-lg uppercase focus:outline-none focus:ring-2 focus:ring-yellow-300">
                        <option>ktp</option>
                        <option>passport</option>
                    </select>
                </div>
                {{-- warga negara --}}
                <div class="">
                    <label for="no-identity" class="block font-medium text-gray-700">&nbsp;</label>
                    <input type="text" id="no-identity" placeholder="no. identitas" class="block w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300" required>
                </div>
            </div>
        </div>

        {{-- grid 3 --}}
        <div class="space-y-4">
            {{-- jumlah tamu --}}
            <div class="">
                <label for="jumlah-dewasa" class="block text-sm lg:text-xs font-semibold text-gray-700">Jumlah Tamu</label>
                <div class="flex space-x-2 mt-1">
                    <select id="jumlah-dewasa" class="block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                        <option>Dewasa</option>
                        <option>1</option>
                        <option>2</option>
                    </select>
                    <select id="jumlah-anak" class="block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                        <option>Anak-anak</option>
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>
            </div>
            <!-- Tanggal / Waktu Check-in -->
            <div>
                <label for="checkin-date" class="block text-sm lg:text-xs font-semibold text-gray-700">Tanggal / Waktu <span class="text-rose-700">Check-In</span></label>
                <div class="flex space-x-2">
                    <input type="date" id="checkin-date" value="2022-05-22" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                    <input type="time" id="checkin-time" value="14:41" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                </div>
            </div>
    
            <!-- Tanggal / Waktu Check-out -->
            <div>
                <label for="checkout-date" class="block text-sm lg:text-xs font-semibold text-gray-700">Tanggal / Waktu <span class="text-rose-700">Check-Out</span></label>
                <div class="flex space-x-2">
                    <input type="date" id="checkout-date" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                    <input type="time" id="checkout-time" value="12:00" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                </div>
            </div>

            <!-- Jumlah Deposit -->
            <div>
                <label for="deposit" class="block text-sm lg:text-xs font-semibold text-gray-700">Jumlah Deposit (Rp)</label>
                <input type="" id="deposit" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300">
            </div>
        </div>

    </div>

    <!-- Buttons -->
    <div class="flex justify-start mt-8 space-x-4 text-sm lg:text-xs">
        <a href="/check-out">
            <button class="bg-green-500 text-white px-4 py-2 font-semibold rounded-md shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 hover:-translate-y-1 duration-300">
                Check In
            </button>
        </a>
    </div>
</div>

@endsection
    
