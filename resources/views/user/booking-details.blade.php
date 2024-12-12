<!-- resources/views/hotel.blade.php -->
@extends('layouts.user')

@section('content')

<div class="max-w-6xl mx-auto lg:text-xs p-3 md:p-12 lg:p-0">
    <div class="flex gap-4">
        
        <x-menu-profile></x-menu-profile>

        <div class="flex-1 bg-white w-full border rounded-lg shadow-md p-4 mx-auto mb-4 text-sm md:text-xs">
            <!-- Header Section -->
            <div class="pb-6 border-b">
                <h1 class="font-bold text-sm">Reservasi</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-20 my-6">
                    <!-- Guest Information -->
                    <div class="order-2 md:order-1 space-y-4">
                        <div class="flex justify-between space-x-4">
                            <p class="text-gray-600">Nama</p>
                            <span>{{ $reservation->user->full_name }}</span>
                        </div>
                        <div class="flex justify-between space-x-4">
                            <p class="text-gray-600">Email</p>
                            <span>{{ $reservation->user->email }}</span>
                        </div>
                        <div class="flex justify-between space-x-4">
                            <p class="text-gray-600">Telepon</p>
                            <span>{{ $reservation->user->phone_number }}</span>
                        </div>
                    </div>
                    {{-- Hotel Information --}}
                    <div class="order-1 md:order-2">
                        <p class="text-gray-900 font-bold">{{ $hotelSetting->name }}</p>
                        <p class="text-[11px] text-gray-600">{{ $hotelSetting->address }}</p>
                        <p class="w-1/3 text-[11px] py-1 px-4 font-semibold mt-2 rounded-r-full bg-yellow-400 text-yellow-900">{{ $reservation->reservation_status }}</p>
                    </div>
                </div>
            </div>

            <!-- Reservation Details -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 items-start gap-4 my-6">
                <div class="text-left space-y-2">
                    <p class="text-[11px] text-gray-600">Nomor Invoice</p>
                    <span class="font-semibold text-black">#{{ $reservation->invoice->invoice_number }}</span>
                </div>
                <div class="text-left space-y-2">
                    <p class="text-[11px] text-gray-600">Tgl. Bayar</p>
                    <span class="font-semibold text-black">
                        {{ \Carbon\Carbon::parse($reservation->payment->payment_date)->format('M d, Y') }}
                    </span>
                </div>
                <div class="text-left space-y-2">
                    <p class="text-[11px] text-gray-600">Total</p>
                    <span class="font-semibold text-black">IDR {{ number_format($reservation->payment->amount, 0, ',', ',') }}</span>
                </div>
                <div class="text-left space-y-2">
                    <p class="text-[11px] text-gray-600">Status</p>
                    <span class="font-semibold
                        {{ $reservation->payment->payment_status === 'success' ? 'text-green-700' : '' }}
                        {{ $reservation->payment->payment_status === 'pending' ? 'text-yellow-600' : '' }}
                        {{ $reservation->payment->payment_status === 'failed' ? 'text-red-600' : '' }}">
                        {{ $reservation->payment->payment_status }}
                    </span>
                </div>
            </div>


            <!-- Room Information -->
            <div class="my-6">
                <h2 class="font-bold text-sm mb-3">Room</h2>
                <table class="w-full text-left border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">Item</th>
                            <th class="border border-gray-300 px-4 py-2">Harga</th>
                            <th class="border border-gray-300 px-4 py-2">Qty</th>
                            <th class="border border-gray-300 px-4 py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">
                                <p class="uppercase">{{ $reservation->roomType->tipe_kamar }}</p>
                                <p class="text-[10px] text-gray-600">
                                    {{ \Carbon\Carbon::parse($reservation->check_in_date)->format('M d, Y') }} 
                                    - 
                                    {{ \Carbon\Carbon::parse($reservation->check_out_date)->format('M d, Y') }}      
                                </p>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">IDR {{ number_format($reservation->roomType->harga, 0, ',', ',') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $reservation->total_room }}</td>
                            <td class="border border-gray-300 px-4 py-2">IDR {{ number_format($reservation->total_price, 0, ',', ',') }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right font-semibold border border-gray-300 px-4 py-2">Total Price</td>
                            <td class="text-base border border-gray-300 px-4 py-2 font-bold">IDR {{ number_format($reservation->total_price, 0, ',', ',') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection