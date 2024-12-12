<!-- resources/views/home.blade.php -->
@extends('layouts/admin')

@section('title', 'detail layanan tamu')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md w-full text-xs">
    <!-- Header -->
    <h1 class="text-lg text-center font-semibold text-gray-700 mb-8">Daftar Layanan Kamar</h1>
    
    <!-- Informasi Tamu dan Kamar -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 pb-3 border-b">
      <div class="">
        <label class="text-gray-900 font-medium">Invoice:</label>
        <p class="text-sm font-semibold text-gray-800">{{ $invoice->invoice_number }}</p>
      </div>
      <div class="">
        <label class="block text-gray-600 font-medium">Nomor Kamar:</label>
        <p class="text-sm font-semibold text-gray-800">{{ $reservation->room->room_number ?? 'N/A' }}</p>
      </div>
      <div class="">
        <label class="block text-gray-600 font-medium">Nama Tamu:</label>
        <p class="text-sm font-semibold text-gray-800">{{ $reservation->user->full_name ?? 'N/A' }}</p>
      </div>
    </div>
  
    <div  class="">
      <div>
        <div class="my-6">
          <div class="flex justify-start mb-5">
            <h2 class="text-sm font-semibold text-gray-700">Daftar Layanan</h2>
          </div>
          <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
              <tr class="bg-gray-100">
                <th class="border border-gray-300 p-2 text-center">No</th>
                <th class="border border-gray-300 p-2 text-left">Nama Item</th>
                <th class="border border-gray-300 p-2 text-center">Harga</th>
                <th class="border border-gray-300 p-2 text-center">Jumlah</th>
                <th class="border border-gray-300 p-2 text-center">Subtotal</th>
                <th class="border border-gray-300 p-2 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($services as $index => $order)
                <tr class="hover:bg-gray-50">
                  <td class="border text-center border-gray-300 p-2">{{ $index + 1 }}</td>
                  <td class="border border-gray-300 p-2">
                    <p>{{ $order->service->name ?? 'N/A' }}</p>
                    <span class="text-[10px] text-gray-500">Waktu pesan : {{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}</span>
                  </td>
                  <td class="border border-gray-300 p-2 text-center">Rp {{ number_format($order->price, 0, ',', ',') }}</td>
                  <td class="border border-gray-300 p-2 text-center">{{ $order->quantity }}</td>
                  <td class="border border-gray-300 p-2 text-center">Rp {{ number_format($order->total_price, 0, ',', ',') }}</td>
                  <td class="flex justify-center items-center space-x-1 border border-gray-300 p-2 text-center">
                    <button onclick="openModal()" class="bg-slate-500 text-white p-1.5 rounded-md hover:bg-slate-600 focus:scale-95 duration-30">
                      <i class="fa-regular fa-eye"></i>
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-gray-500 p-6">Tidak ada layanan yang dipesan.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      
        <!-- Total Harga -->
        <div class="flex justify-end mt-4">
          <div class="border-b-2 border-gray-200 p-4 w-full max-w-md">
            <div class="flex justify-between items-center">
              <span class="text-gray-700 font-semibold">Total Harga:</span>
              <span class="text-xl text-rose-900 font-semibold">Rp {{ number_format($totalHarga, 0, ',', ',') }}</span>
            </div>
          </div>
        </div>
        
      </div>
      
    </div>
    
</div>


<!-- Modal Popup -->
<div id="detailsModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white shadow-lg p-4 w-full md:w-1/4 text-xs  border border-gray-300">
        <h2 class="text-base text-center font-semibold text-gray-800 mb-6">DETAIL PEMESANAN</h2>
        <div class="space-y-5">
            <div class="flex justify-between">
                <span class="text-gray-700">Tanggal:</span>
                <span class="font-medium text-gray-800">12 Desember 2024</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-700">Layanan:</span>
                <span class="font-medium text-gray-800">Nasi Goreng Spesial</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-700">Harga:</span>
                <span class="font-medium text-gray-800">Rp 25.000</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-700">Jumlah:</span>
                <span class="font-medium text-gray-800">2</span>
            </div>
            <div class="flex justify-between border-t border-gray-300 pt-2 mt-2">
                <span class="text-gray-700">Total:</span>
                <span class="font-semibold text-gray-800">Rp 50.000</span>
            </div>
            <div class="flex flex-col mt-2">
                <span class="text-gray-700">Catatan:</span>
                <span class="font-medium text-gray-800 mt-2">Tidak ada tambahan.</span>
            </div>
        </div>
        <div class="mt-8 text-center">
            <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-1 rounded hover:bg-gray-600">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('detailsModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('detailsModal').classList.add('hidden');
    }


  // Script untuk memilih semua checkbox
function selectAllCheckboxes() {
  const checkboxes = document.querySelectorAll('input[name="service_ids[]"]');
  const selectAllCheckbox = document.getElementById('selectAll');
  checkboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
}

// Function to collect selected service IDs and append them to the form as hidden inputs
// function collectSelectedServices() {
//   const form = document.getElementById('printForm');
//   const selectedServicesContainer = document.getElementById('selectedServicesContainer');
//   selectedServicesContainer.innerHTML = ''; // Clear previous inputs

//   const checkboxes = document.querySelectorAll('input[name="service_ids[]"]:checked');
//   checkboxes.forEach(checkbox => {
//     const input = document.createElement('input');
//     input.type = 'hidden';
//     input.name = 'service_ids[]'; // Pastikan nama input sesuai dengan di controller
//     input.value = checkbox.value;
//     selectedServicesContainer.appendChild(input);
//   });

//   if (checkboxes.length > 0) {
//     form.submit();
//   } else {
//     alert('Silakan pilih layanan yang ingin dicetak.');
//   }
// }



//     function deleteService(orderId) {
//         if (confirm("Apakah Anda yakin ingin menghapus layanan ini?")) {
//             fetch(`/delete-service`, {
//                 method: "POST",
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
//                 },
//                 body: JSON.stringify({ order_id: orderId })
//             })
//             .then(response => response.json())
//             .then(data => {
//                 alert(data.message);
//                 location.reload(); // Refresh halaman setelah penghapusan
//             });
//         }
//     }


</script>
  
@endsection