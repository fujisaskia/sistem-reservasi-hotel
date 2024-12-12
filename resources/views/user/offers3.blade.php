<!-- resources/views/hotel.blade.php -->
@extends('layouts.user')

@section('content')

<div class="max-w-6xl mx-auto text-sm lg:text-xs">
    <div class="flex gap-4">
        <!-- Room List Section -->
        <div class="flex-1 space-y-4 px-2 lg:px-0">
            <div class="bg-white lg:flex-row items-center justify-between p-4 space-y-2 rounded-xl sticky top-4 lg:top-10 border-b lg:border border-gray-200 shadow-md">
                <div class="flex items-center justify-between md:justify-center hover:shadow-sm space-x-4 p-0 lg:p-3 lg:border lg:border-gray-300 rounded-lg duration-300">
                    <div class="flex items-center space-x-2 text-xs lg:text-sm">
                        <!-- Date Input -->
                        <div class="flex items-center space-x-2 px-1" id="datePickerTrigger">
                            <i class="fa-solid fa-calendar-days fa-lg text-rose-500"></i>
                            <input type="text" id="check-in" name="check_in_date" class="flatpickr border-none focus:outline-none text-right" placeholder="Check-in">
                            <span>-</span>
                            <input type="text" id="check-out" name="check_out_date" class="flatpickr border-none focus:outline-none" placeholder="Check-out">
                            {{-- nightsCount --}}
                            <span id="number_of_night" class="lg:block hidden text-xs font-normal border border-rose-500 bg-rose-100 px-3 py-1 rounded-full">0 nights</span>
                        </div>
                    </div>
                    <!-- Update Button -->
                    <button id="searchButton" class="bg-yellow-500 hover:bg-yellow-600 shadow-md hover:shadow-sm text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-4 focus:ring-yellow-300 duration-300">
                        Search
                    </button>
                </div>
                <!-- Filter Options -->
                <div class="space-y-2 pt-2 border-t md:border-none text-xs ">
                    <label for="countries" class="">Try these filters   :</label>
                    {{-- kategori tipe kamar yang diambil dari tb room_types --}}
                    <select id="roomTypeFilter" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-yellow-300 block w-2/3 lg:w-1/3 p-2">
                        <option value="">All Types</option>
                        @foreach($roomTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->tipe_kamar }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="roomsSection" class="">
                {{-- relative --}}
                {{-- Rooms Section --}}
                @include('components.room-card')
                {{-- Room Section End --}}
            </div>

        </div>
        
        <!-- Summary Desktop Section -->
        <div class="hidden lg:block w-full lg:w-1/4 bg-white p-4 rounded-lg shadow-md sticky top-4 self-start">
            <h3 class="text-lg font-semibold mb-4">Room Summary</h3>
            {{-- tanggal check-in & check-out --}}
            <p class="text-gray-600 mb-2"><i class="far fa-calendar-alt mr-1"></i> <span id="summaryDate">01 Nov - 02 Nov, 2024</span></p>

            <div id="cartSummary" class="space-y-2 my-2 bg-gray-100 p-1 rounded">
                 <p class="font-semibold">Tipe kamar</p>
                 <div class="flex justify-between text-[11px]">
                     <p class="text-gray-600" id="room-quantity">1 Room x 1 night(s)</p>
                     <p class="text-gray-800 font-semibold" id="room-total">IDR 500,000</p>
                 </div>
            </div>
            <div id="cartSummary" class="space-y-2 my-2 bg-gray-100 p-1 rounded">
                 <p class="font-semibold">Tipe kamar</p>
                 <div class="flex justify-between text-[11px]">
                     <p class="text-gray-600" id="room-quantity">1 Room x 1 night(s)</p>
                     <p class="text-gray-800 font-semibold" id="room-total">IDR 500,000</p>
                 </div>
            </div>

            <div class="border-t my-4"></div>
            <div class="flex justify-between text-lg font-semibold">
                <span>Total</span>
                <span id="cartTotal">IDR 0</span>
            </div>
            <div class="mt-4 flex space-x-2 justify-between text-center">
                <a href="/confirmation" class="flex-1 px-4 py-2 shadow-md hover:shadow-none bg-rose-600 hover:bg-rose-700 focus:bg-rose-600 text-white rounded focus:outline-none focus:ring-2 focus:ring-rose-300">Book Now</a>
            </div>
        </div>

    </div>
</div>

{{-- Summary Mobile Bottom --}}
<div x-data="{ open: false }" class="lg:hidden">
    <div  @click="open = true"  class="fixed bottom-0 left-0 w-full z-30 shadow-lg border-t-2 border-gray-200">
        <div class="flex items-center justify-between bg-white p-4 border-t border-gray-200 shadow-md">
            <div class="flex items-center space-x-3">
                <i class="fa-solid fa-chevron-up text-gray-700"></i>
                <div>
                    <p class="text-xs text-gray-700">Total Price</p>
                    <p class="uppercase text-xl font-semibold text-rose-800">IDR 10,508,200</p>
                </div>
            </div>
            <a href="/confirmation" class="py-2 px-6 font-semibold text-white bg-rose-600 rounded-md hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-300">
                Continue
            </a>
        </div>
    </div>


      <!-- Modal -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-full"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-full"
        class="fixed bottom-0 left-0 right-0 bg-white text-sm border border-gray-400 px-6 rounded-t-3xl shadow-lg z-30">
        
        <!-- Tombol Close -->
        <button @click="open = false" class="space-x-2 pt-4 text-gray-500 text-sm hover:text-gray-700 block mx-auto">
            <i class="fa-solid fa-chevron-down"></i>
        </button>

        <div class="my-6">
            <h2 class="text-lg font-semibold pb-4 border-b border-gray-300 text-center">Room Cart</h2>
            <div class="py-3 border-y-4 border-slate-200">
                <h2 class="text-sm font-semibold text-gray-700">ROOM</h2>
                {{-- room 1 --}}
                <div class="flex items-center space-x-4 py-3">
                    <!-- Room Image -->
                    <img src="{{ asset('assets/room.jpg') }}" alt="Room Image" class="w-16 h-16 rounded-md object-cover">
                    <div class="flex flex-grow justify-between items-center">
                        <!-- Room Details -->
                        <div class="text-left space-y-1">
                            <p class="font-semibold text-gray-800">Superior Twin</p>
                            <p class="text-xs text-gray-500">1 room x 1 night</p>
                        </div>
                        <!-- Quantity and Price -->
                        <div class="items-end space-x-2 ml-auto text-end space-y-1">
                            {{-- <button class="p-1 text-gray-500 hover:text-gray-700">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                            <button class="p-1 text-gray-500 hover:text-gray-700 border border-gray-300 rounded">-</button>
                            <span class="px-2">1</span>
                            <button class="p-1 text-gray-500 hover:text-gray-700 border border-gray-300 rounded">+</button> --}}
                            <p class="font-medium uppercase text-gray-800 text-right">IDR 508,207</p>
                        </div>
                    </div>
                </div>
            
                {{-- room 2 --}}
                <div class="flex items-center space-x-4 py-3">
                    <!-- Room Image -->
                    <img src="{{ asset('assets/suite.jpg') }}" alt="Room Image" class="w-16 h-16 rounded-md object-cover">
                    <div class="flex flex-grow justify-between items-center">
                        <!-- Room Details -->
                        <div class="text-left space-y-1">
                            <p class="font-semibold text-gray-800">Jump Suite</p>
                            <p class="text-xs text-gray-500">1 room x 1 night</p>
                        </div>
                        <!-- Quantity and Price -->
                        <div class="items-end space-x-2 ml-auto text-end space-y-1">
                            {{-- <button class="p-1 text-gray-500 hover:text-gray-700">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                            <button class="p-1 text-gray-500 hover:text-gray-700 border border-gray-300 rounded">-</button>
                            <span class="px-2">1</span>
                            <button class="p-1 text-gray-500 hover:text-gray-700 border border-gray-300 rounded">+</button> --}}
                            <p class="font-medium uppercase text-gray-800 text-right">IDR 508,207</p>
                        </div>
                    </div>
                </div>
            
                <!-- Subtotal -->
                <div class="border-t border-gray-200 pt-4">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-700 font-semibold">Subtotal</span>
                        <span class="font-semibold text-gray-800 text-right">IDR 508,200</span>
                    </div>
                </div>
            </div>
            
            <!-- Total Payment -->
            <div class="border-t border-gray-200 pt-4 bg-yellow-50 rounded-lg p-3 mt-4">
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Total Payment</span>
                    <span class="text-xl text-right font-semibold text-gray-800">IDR 10,508,200</span>
                </div>
            </div>

            <!-- Tombol Check Availability -->
            <div class="mt-6 mb-14 block">
                <a href="/offers">
                <button class="w-full bg-rose-500 text-white py-3 font-semibold rounded-md hover:bg-white hover:text-rose-700 focus:outline-none focus:ring focus:ring-yellow-600">Continue</button>
                </a>
            </div>
        </div>
    </div>
</div>
  

{{-- detail room end--}}

<script>
    //kategory filter room
    document.getElementById('roomTypeFilter').addEventListener('change', function() {
        var selectedType = this.value;
        var roomCards = document.querySelectorAll('.room-card');
        
        roomCards.forEach(function(card) {
            if (selectedType === "" || card.getAttribute('data-room-type') === selectedType) {
                card.style.display = 'flex'; // Tampilkan room card jika sesuai kategori
            } else {
                card.style.display = 'none'; // Sembunyikan room card jika tidak sesuai kategori
            }
        });
    });


    // kustomisasi tanggal
    document.addEventListener('DOMContentLoaded', function () {
        let checkInDate = null;
        let checkOutDate = null;
        const searchButton = document.getElementById('searchButton');
        const roomsSection = document.getElementById('roomsSection');

        // Inisialisasi Flatpickr untuk Check-In
        flatpickr("#check-in", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d", // Format yang dikirim ke server
            minDate: "today", // Mulai dari hari ini
            onChange: function (selectedDates) {
                checkInDate = selectedDates[0];
                calculateNights();
            },
        });

        // Inisialisasi Flatpickr untuk Check-Out
        flatpickr("#check-out", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d", // Format yang dikirim ke server
            minDate: "today", // Mulai dari hari ini
            onChange: function (selectedDates) {
                checkOutDate = selectedDates[0];
                calculateNights();
            },
        });

        // Fungsi untuk menghitung jumlah malam
        function calculateNights() {
            if (checkInDate && checkOutDate) {
                const timeDiff = checkOutDate - checkInDate;
                const nightsCount = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Konversi ms ke hari

                // Update UI
                document.getElementById("number_of_night").textContent = `${nightsCount} nights`;

                // Validasi untuk input
                if (nightsCount <= 0) {
                    alert("Check-out date must be after Check-in date!");
                    document.getElementById("check-out").value = "";
                    document.getElementById("number_of_night").textContent = `0 nights`;
                }
            }
        }
        // searchButton.addEventListener('click', function () {
        //     // Tambahkan spinner overlay
        //     const spinnerOverlay = document.createElement('div');
        //     spinnerOverlay.className = 'spinner-overlay';
        //     spinnerOverlay.innerHTML = '<div class="spinner"></div>';
        //     roomsSection.appendChild(spinnerOverlay);

        //     // Simulasikan proses pencarian (delay)
        //     setTimeout(() => {
        //         // Hapus spinner setelah selesai
        //         roomsSection.removeChild(spinnerOverlay);
        //     }, 1000); // 2 detik
        // });
    });

    // document.addEventListener('DOMContentLoaded', function () {
    //     const updateButton = document.getElementById('updateButton');
    //     const roomsContainer = document.getElementById('roomsContainer');
    //     const nightsCountElement = document.getElementById('number_of_night');
    //     const checkInInput = document.getElementById('check-in');
    //     const checkOutInput = document.getElementById('check-out');

    //     function saveToLocalStorage() {
    //         const checkInDate = checkInInput.value;
    //         const checkOutDate = checkOutInput.value;
    //         const nightsCount = calculateNights();

    //         localStorage.setItem('checkInDate', checkInDate);
    //         localStorage.setItem('checkOutDate', checkOutDate);
    //         localStorage.setItem('nightsCount', nightsCount);
    //     }

    //     function loadFromLocalStorage() {
    //         const checkInDate = localStorage.getItem('checkInDate');
    //         const checkOutDate = localStorage.getItem('checkOutDate');
    //         const nightsCount = localStorage.getItem('nightsCount');

    //         if (checkInDate && checkOutDate && nightsCount) {
    //             checkInInput.value = checkInDate;
    //             checkOutInput.value = checkOutDate;
    //             nightsCountElement.textContent = `${nightsCount} nights`;

    //             updatePrices();
    //             updateRoomNights(nightsCount);
    //         }
    //     }

    //     function calculateNights() {
    //         const checkInDate = new Date(checkInInput.value);
    //         const checkOutDate = new Date(checkOutInput.value);

    //         if (checkInDate && checkOutDate && checkOutDate > checkInDate) {
    //             const timeDiff = Math.abs(checkOutDate - checkInDate);
    //             return Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
    //         }
    //         return 0;
    //     }

    //     function updatePrices() {
    //         const nightsCount = calculateNights();

    //         roomsContainer.querySelectorAll('.room-card').forEach(roomCard => {
    //             const priceElement = roomCard.querySelector('[id^="roomPrice"]');
    //             const basePrice = parseInt(priceElement.getAttribute('data-base-price'));

    //             const newPrice = basePrice * nightsCount;
    //             priceElement.textContent = newPrice.toLocaleString('id-ID');
    //         });
    //     }

    //     function updateRoomNights(nightsCount) {
    //         roomsContainer.querySelectorAll('.room-card').forEach(roomCard => {
    //             const nightsDisplay = roomCard.querySelector('#displayNights');
    //             nightsDisplay.textContent = nightsCount;
    //         });
    //     }

    //     // Update hidden inputs sebelum form disubmit
    //     function updateHiddenInputs() {
    //         roomsContainer.querySelectorAll('.room-card').forEach(roomCard => {
    //             const nightsCount = calculateNights();
    //             const roomId = roomCard.getAttribute('data-room-type');

    //             const checkInDate = checkInInput.value;
    //             const checkOutDate = checkOutInput.value;

    //             document.getElementById(`check_in_date_${roomId}`).value = checkInDate;
    //             document.getElementById(`check_out_date_${roomId}`).value = checkOutDate;
    //             document.getElementById(`nights_count_${roomId}`).value = nightsCount;
    //         });
    //     }

    //     updateButton.addEventListener('click', function (event) {
    //         event.preventDefault();
    //         const nightsCount = calculateNights();

    //         saveToLocalStorage();
    //         nightsCountElement.textContent = `${nightsCount} nights`;
    //         updatePrices();
    //         updateRoomNights(nightsCount);
    //         updateHiddenInputs(); // Update hidden inputs sebelum form disubmit
    //     });

    //     // loadFromLocalStorage();
    // });

</script>



@endsection
