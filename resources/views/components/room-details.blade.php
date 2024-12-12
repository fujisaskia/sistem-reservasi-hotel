<!-- Modal Container -->
<div 
    x-show="detailsRoom"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-10 px-3"
    @click.away="detailsRoom = false"
    x-transition
    style="display: none;"
>
<div class="relative bg-white rounded-lg shadow-lg max-w-lg lg:max-w-5xl w-full h-[80%] overflow-hidden p-4">
        <!-- Close Button -->
        <button @click="detailsRoom = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 z-50">
            <i class="fa-solid fa-x text-lg"></i>
        </button>

        <div class="flex flex-col lg:flex-row h-full items-start justify-start">
            <!-- Image Section -->
            <div class="w-full lg:w-1/2 h-1/3 lg:h-full bg-gray-200 p-2 rounded-md">
                @php
                    $fotos = json_decode($roomType->foto); // Mendecode JSON path foto
                @endphp
                @if ($fotos)
                    @foreach($fotos as $foto)
                        <img src="{{ asset('storage/' . $foto) }}" alt="Room Image" class="w-full h-full object-cover">
                    @endforeach
                @else
                    <img src="https://via.placeholder.com/400x250" alt="Room Image" class="rounded-md">
                @endif
            </div>

            <!-- Content Section -->
            <div class="w-full lg:w-1/2 p-4 overflow-y-auto no-scrollbar max-h-full">
                <h2 class="text-xl md:text-2xl font-bold mb-4">{{ $roomType->tipe_kamar }}</h2>

                <!-- Price -->
                <div class="space-y-2 mb-6">
                    <p class="text-gray-600">Starting from</p>
                    <p class="text-2xl font-semibold">IDR {{ number_format($roomType->harga, 0, ',', ',') }} <span class="text-sm md:text-xs font-normal">/room/night</span></p>
                </div>

                <!-- Room Description -->
                <div class="mb-5">
                    <div class="flex items-center space-x-2 mb-2">
                        <i class="fa-solid fa-marker text-gray-500"></i>
                        <h3 class="font-semibold">Room Description:</h3>
                    </div>
                    <p class="text-gray-700">{{ $roomType->deskripsi_kamar }}</p>
                </div>

                <!-- Room Information -->
                <div class="mb-5">
                    <div class="flex items-center space-x-2 mb-2">
                        <i class="fa-solid fa-circle-info text-gray-500"></i>
                        <h3 class="font-semibold">Room Information:</h3>
                    </div>
                    <div class="flex items-center mb-4 text-gray-600">
                        <div class="flex space-x-2 items-center">
                            <i class="fa-solid fa-user"></i>
                            <span>{{ $roomType->kapasitas }} Adult(s)</span>
                        </div>
                    </div>
                </div>

                <!-- Room Facilities -->
                <div>
                    <div class="flex items-center space-x-2 mb-2">
                        <i class="fa-solid fa-leaf text-gray-500"></i>
                        <h3 class="font-semibold">Room Facilities:</h3>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between text-left text-gray-600">
                            <ul class="leading-relaxed">
                                <li><i class="fa-solid fa-check mr-1"></i>{{ $roomType->fasilitas }}</li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
</div>


</div>