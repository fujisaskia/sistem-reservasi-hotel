<div x-show="openDetailReservasi" 
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 px-4"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">

    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-auto relative">
        <!-- Tombol untuk menutup modal -->
        <button @click="openDetailReservasi = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <i class="fa-solid fa-times fa-lg"></i>
        </button>

        <!-- Konten Detail Reservasi -->
        <div class="mb-6 space-y-2">
            <h2 class="text-xl font-semibold text-center text-blue-900">Detail Reservasi</h2>
            <div class="w-1/3 h-1 bg-blue-900 mx-auto rounded-full"></div>
        </div>

{{-- detail reservasi --}}
<div class="space-y-5">
    <div class="flex justify-between pb-2 border-b border-gray-300">
        <span class="font-semibold">Nama Tamu:</span>
        <span class="text-rose-800">{{  $reservation->user->full_name  }}</span>
    </div>
    <div class="flex justify-between pb-2 border-b border-gray-300">
        <span class="font-semibold">Invoice Number:</span>
        <span class="text-rose-800">
            #{{ $reservation->invoice->invoice_number ?? 'Belum Ada Invoice' }}
        </span>
    </div>    
    <div class="flex justify-between pb-2 border-b border-gray-300">
        <span class="font-semibold">Tipe Kamar:</span>
        <span class="text-rose-800">{{ $reservation->roomType->tipe_kamar }}</span>
    </div>
    <div class="flex justify-between pb-2 border-b border-gray-300">
        <span class="font-semibold">Harga (IDR):</span>
        <span class="text-rose-800">IDR {{ number_format($reservation->total_price, 0, ',', ',') }}</span>
    </div>
    <div class="flex justify-between pb-2 border-b border-gray-300">
        <span class="font-semibold">Jumlah Kamar:</span>
        <span class="text-rose-800">{{ $reservation->total_room }} Kamar</span>
    </div>
    <div class="flex justify-between pb-2 border-b border-gray-300">
        <span class="font-semibold">Jumlah Tamu:</span>
        <span class="text-rose-800">{{ $reservation->total_guest }} Tamu</span>
    </div>
    <div class="flex justify-between pb-2 border-b border-gray-300">
        <span class="font-semibold">Tanggal Reservasi:</span>
        <span class="text-rose-800">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }}</span>
    </div>
    <div class="flex justify-between pb-2 border-b border-gray-300">
        <span class="font-semibold">Tanggal Check-In:</span>
        <span class="text-rose-800">{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('M d, Y') }}</span>
    </div>
    <div class="flex justify-between pb-2 border-b border-gray-300">
        <span class="font-semibold">Tanggal Check-Out:</span>
        <span class="text-rose-800">{{ \Carbon\Carbon::parse($reservation->check_out_date)->format('M d, Y') }}</span>
    </div>
    <div class="flex justify-between pb-2 border-b border-gray-300">
        <span class="font-semibold">Status Reservasi:</span>
        <span>
            <p class="py-1 px-2 text-xs text-white rounded-full text-center italic
                @if ($reservation->reservation_status === 'Pending') 
                    bg-yellow-100 text-yellow-700 
                @elseif ($reservation->reservation_status === 'Confirmed') 
                    bg-green-100 text-green-600 
                @elseif ($reservation->reservation_status === 'Checked-In') 
                    bg-blue-100 text-blue-600 
                @elseif ($reservation->reservation_status === 'Checked-Out') 
                    bg-rose-100 text-rose-600 
                @elseif ($reservation->reservation_status === 'Cancelled') 
                    bg-red-100 text-red-700 
                @endif">
                {{ $reservation->reservation_status }}
            </p>
        </span>
    </div>
</div>

    </div>
</div>