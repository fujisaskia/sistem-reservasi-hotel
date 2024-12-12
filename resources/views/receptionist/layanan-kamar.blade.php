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
      @foreach($categories as $category)
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
              <th class="border border-gray-300 p-3 text-center sticky top-0 bg-gray-100">Jumlah</th>
              <th class="border border-gray-300 p-3 text-center sticky top-0 bg-gray-100">Aksi</th>
            </tr>
          </thead>
          <tbody id="serviceItems">
            @foreach($services as $service)
            <tr data-id="{{ $service->id }}" data-name="{{ $service->name }}" data-price="{{ $service->price }}">
              <td class="border border-gray-300 p-2">{{ $service->name }}</td>
              <td class="border border-gray-300 p-2 text-right">Rp {{ number_format($service->price, 0, ',', ',') }}</td>
              <td class="border border-gray-300 p-2 text-center">
                <input type="number" min="1" value="1" class="w-20 border p-1.5 border-gray-300 rounded-full text-center focus:outline-none quantity">
              </td>
              <td class="border border-gray-300 p-2 text-center">
                <button class="bg-blue-500 text-white px-4 py-1 rounded-md hover:bg-blue-600 add-to-summary">Tambah</button>
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
      <li class="flex justify-between items-center text-base text-rose-900 font-semibold">
        <span class="">Total</span>
        <span id="totalAmount" class="">Rp 0</span>
      </li>
    </ul>
  </div>

  <div class="flex justify-end">
    <button id="saveOrder" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600">Simpan Pesanan</button>
  </div>
</div>

<script>
    document.getElementById('kategori').addEventListener('change', function () {
        const categoryId = this.value;
        fetch(`/layanan-kamar/{{ $reservation->id }}?category_id=${categoryId}`)
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            document.querySelector('#serviceItems').innerHTML = doc.querySelector('#serviceItems').innerHTML;
            addEventListenersToButtons();
        });
    });

    let orders = [];

    function updateSummary() {
        const orderSummary = document.getElementById('orderSummary');
        const totalAmount = document.getElementById('totalAmount');
        orderSummary.innerHTML = '';

        let total = 0;
        orders.forEach(order => {
            const subtotal = order.price * order.quantity;
            total += subtotal;
            orderSummary.innerHTML += `<li class='flex justify-between items-center border-b border-gray-300 pb-2 mb-2'>
                                        <span>${order.name} x${order.quantity}</span>
                                        <span class='font-semibold'>Rp ${subtotal.toLocaleString('id-ID')}</span>
                                        </li>`;
        });

        orderSummary.innerHTML += `<li class='flex justify-between items-center font-semibold text-base text-rose-900'>
                                    <span>Total</span>
                                    <span>Rp ${total.toLocaleString('id-ID')}</span>
                                    </li>`;
        totalAmount.textContent = `Rp ${total.toLocaleString('id-ID')}`;
    }

    function addEventListenersToButtons() {
        document.querySelectorAll('.add-to-summary').forEach(button => {
            button.addEventListener('click', function () {
                const row = this.closest('tr');
                const id = row.dataset.id;
                const name = row.dataset.name;
                const price = parseInt(row.dataset.price);
                const quantity = parseInt(row.querySelector('.quantity').value) || 1;

                const existingOrder = orders.find(order => order.id === id);

                if (existingOrder) {
                    orders = orders.filter(order => order.id !== id);
                    this.textContent = 'Tambah';
                    this.classList.remove('bg-red-500', 'hover:bg-red-600');
                    this.classList.add('bg-blue-500', 'hover:bg-blue-600');
                } else {
                    orders.push({ id, name, price, quantity });
                    this.textContent = 'Hapus';
                    this.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                    this.classList.add('bg-red-500', 'hover:bg-red-600');
                }

                updateSummary();
            });
        });
    }

    addEventListenersToButtons();

    document.getElementById('saveOrder').addEventListener('click', function () {
        if (orders.length === 0) {
            alert('Tidak ada layanan yang dipilih.');
            return;
        }

        fetch('{{ route("layanan.createOrder") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                orders: orders.map(order => ({
                    id: order.id,
                    quantity: order.quantity,
                    price: order.price,
                })),
                reservation_id: {{ $reservation->id }},
            }),
        })
        .then(response => {
            console.log('HTTP Response:', response);
            if (response.ok) {
                return response.json();
            } else {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
        })
        .then(data => {
            console.log('Response Data:', data);
            alert(data.message || 'Pesanan berhasil disimpan!');
            if (data.redirect) {
                window.location.href = data.redirect; // Redirect ke URL yang dikembalikan dari server
            }
            orders = [];
            updateSummary();
        })
        .catch(error => {
            console.error('Error:', error);
        });

    });
</script>

@endsection
