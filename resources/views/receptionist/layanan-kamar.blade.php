// View: layanan_kamar.blade.php

@extends('layouts.receptionist')

@section('title', 'Layanan Kamar')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md w-full text-xs">
        <h1 class="text-lg text-center font-semibold text-gray-700 mb-8">Input Layanan Kamar</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 pb-3 border-b">
            <div>
                <label class="text-gray-900 font-medium">Invoice:</label>
                <p class="text-sm font-semibold text-gray-800">{{ $invoice->invoice_number }}</p>
            </div>
            <div>
                <label class="block text-gray-600 font-medium">Nomor Kamar:</label>
                <p class="text-sm font-semibold text-gray-800">{{ $reservation->room->room_number }}</p>
            </div>
            <div>
                <label class="block text-gray-600 font-medium">Nama Tamu:</label>
                <p class="text-sm font-semibold text-gray-800">{{ $reservation->user->full_name }}</p>
            </div>
        </div>

        <div class="flex space-x-4 mb-4 items-center mt-5">
            <label for="kategori" class="block text-gray-600 font-medium mb-1">Pilih Kategori Layanan:</label>
            <select id="kategori" class="flex-1 p-2 border-b-2 border-gray-100 focus:outline-none">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <h2 class="text-sm font-semibold text-gray-900 mb-2">Daftar Layanan</h2>
            <div class="max-h-[300px] overflow-x-auto overflow-y-auto">
                <table class="text-xs table-auto w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100 text-gray-600 uppercase">
                        <tr>
                            <th class="border border-gray-300 p-3 text-left sticky top-0 bg-gray-100">Nama Item</th>
                            <th class="border border-gray-300 p-3 text-right sticky top-0 bg-gray-100">Harga</th>
                            <th class="border border-gray-300 p-3 text-center sticky top-0 bg-gray-100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="serviceItems">
                        @foreach ($services as $service)
                            <tr data-id="{{ $service->id }}" data-name="{{ $service->name }}"
                                data-price="{{ $service->price }}">
                                <td class="border border-gray-300 p-2">{{ $service->name }}</td>
                                <td class="border border-gray-300 p-2 text-right">Rp
                                    {{ number_format($service->price, 0, ',', ',') }}</td>
                                <td class="border border-gray-300 p-2 text-center">
                                    <button
                                        class="bg-blue-500 text-white px-4 py-1 rounded-md hover:bg-blue-600 add-to-summary">Tambah</button>
                                        
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <div class="mb-6">
            <h2 class="text-sm font-semibold text-gray-900 mb-2">Ringkasan Pesanan</h2>
            <ul id="orderSummary" class="border border-gray-300 rounded-md p-4 bg-gray-50">
                @if ($serviceOrders->isEmpty())
                    <p class="text-gray-500 italic">Tidak ada layanan tamu yang dipesan.</p>
                @else
                @foreach ($serviceOrders as $order)
                <div class="flex justify-between mb-3">
                    <p>{{ $order->service->name }}</p>
                    <p>IDR {{ number_format($order->price, 0, ',', '.') }}</p>
                    <button onclick="deleteService({{ $order->id }})" class="text-rose-700 hover:text-rose-800 hover:scale-105 focus:scale-95 duration-300">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            @endforeach
            
        
                    <li class="flex justify-between items-center text-base text-rose-900 font-semibold pt-3 border-t">
                        <span>Total</span>
                        <span id="totalAmount">IDR {{ number_format($totalAmount, 0, ',', '.') }}</span>
                    </li>
                @endif
            </ul>
        </div>
        

        <div class="flex justify-end">
            <button id="saveOrder" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600">Pesan
                Layanan</button>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        document.getElementById('kategori').addEventListener('change', function() {
            const categoryId = this.value;
            fetch(`/layanan-kamar/{{ $reservation->id }}?category_id=${categoryId}`)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    document.querySelector('#serviceItems').innerHTML = doc.querySelector('#serviceItems')
                        .innerHTML;
                        addEventListenersToButtons();
                    });
                });
                
                    function deleteService(orderId) {
                        if (confirm("Apakah Anda yakin ingin menghapus layanan ini?")) {
                            fetch(`/delete-service`, {
                                method: "POST",
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ order_id: orderId })
                            })
                            .then(response => response.json())
                            .then(data => {
                                alert(data.message);
                                location.reload(); // Refresh halaman setelah penghapusan
                            });
                        }
                    }
        // proses untuk menambahkan service order
        document.addEventListener('DOMContentLoaded', function() {
            const reservationId = "{{ $reservation->id }}"; // Tetapkan di luar semua fungsi
            const addButtons = document.querySelectorAll('.add-to-summary');
            const orderSummary = document.getElementById('orderSummary');
            let totalAmount = 0;

            // Tambahkan layanan ke ringkasan
            addButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const serviceRow = button.closest('tr');
                    const serviceId = serviceRow.dataset.id;
                    const serviceName = serviceRow.dataset.name;
                    const servicePrice = parseFloat(serviceRow.dataset.price);

                    // Kirim data ke backend
                    fetch("{{ route('service-orders.add') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            reservation_id: reservationId,
                            service_id: serviceId,
                            price: servicePrice,
                            status_order: 'unpaid' // Tetapkan status unpaid
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                        // Refresh halaman untuk memperbarui ringkasan
                        location.reload();
                    }
                    })
                    .catch(error => console.error('Error adding service:', error));

            });
        });


        // Proses pembayaran
        document.getElementById('saveOrder').addEventListener('click', function() {
            fetch('/payment-service/snap-token', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ reservation_id: reservationId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.snapToken) {
                    window.snap.pay(data.snapToken, {
                        onSuccess: function(result) {
                            fetch('/payment-service/success', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    order_id: result.order_id,
                                    payment_status: 'success'
                                })
                            })
                            .then(response => response.json())
                            .then(statusResponse => {
                                alert(statusResponse.message);
                            });
                        },
                        onPending: function() {
                            alert("Transaksi tertunda.");
                        },
                        onError: function() {
                            alert("Terjadi kesalahan saat memproses pembayaran.");
                        },
                        onClose: function() {
                            alert("Pembayaran dibatalkan.");
                        }
                    });
                } else {
                    alert("Gagal mendapatkan Snap Token.");
                }
            })
            .catch(error => console.error('Error:', error));
        });
});

    </script>

@endsection
