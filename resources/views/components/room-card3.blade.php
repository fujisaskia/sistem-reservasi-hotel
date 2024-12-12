            {{-- Rooms Section--}}
                {{-- room card --}}
                <div id="roomsContainer" class="md:max-w-lg lg:max-w-6xl mx-auto space-y-6">
                    @foreach($roomTypes as $roomType)
                    <div class="room-card p-6 lg:p-4 rounded-lg shadow-md flex flex-col lg:flex-row lg:space-x-4 mx-4 lg:mx-0 
                        {{ $roomType->available_rooms_count > 0 ? 'bg-white' : 'bg-gray-300' }}" 
                        data-room-type="{{ $roomType->id }}" data-nights="1">
                        
                        {{-- room image --}}
                        <div class="flex flex-col space-y-2 lg:w-1/3">
                            @php
                            $fotos = json_decode($roomType->foto); // Mendecode JSON path foto
                            @endphp
                            @if ($fotos)
                                @foreach($fotos as $foto)
                                    <img src="{{ asset('storage/' . $foto) }}" alt="Room Image" class="rounded-md mb-2">
                                @endforeach
                            @else
                                <img src="https://via.placeholder.com/400x250" alt="Room Image" class="rounded-md">
                            @endif
                        </div>
                
                        {{-- room info --}}
                        <div class="flex flex-col lg:w-2/3 mt-3 lg:mt-0">
                            <div class="space-y-2">        
                                {{-- nama tipe kamar --}}
                                <h4 class="text-lg font-medium uppercase">{{ $roomType->tipe_kamar }}</h4>
                                {{-- harga kamar --}}
                                <h3 class="text-2xl font-semibold uppercase">
                                    IDR <span id="roomPrice" data-base-price="{{ $roomType->harga }}">{{ number_format($roomType->harga, 0, ',', ',') }}</span>
                                    <span class="text-sm lg:text-xs text-gray-700 ml-2 normal-case font-medium">/room<span id="displayNights">/</span>night</span>
                                </h3>                                                              
                
                                {{-- kapasitas kamar --}}
                                <div class="flex space-x-4 text-gray-600">
                                    <span><i class="fas fa-user"></i> {{ $roomType->kapasitas }} Adult(s)</span>
                                    @if ($roomType->available_rooms_count > 0)
                                        <span class="text-red-700 italic text[10px]">{{ $roomType->available_rooms_count }} kamar terakhir kami</span>
                                    @else
                                        <span class="text-red-700">Maaf, kamar saat ini tidak tersedia</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-between mt-12">
                                {{-- Tombol Details Room --}}
                                <div x-data="{ detailsRoom: false }">
                                    <!-- Button to Open Modal -->
                                    <button @click="detailsRoom = true" class="py-2 px-2 items-start text-blue-500 hover:text-blue-600 justify-start font-semibold rounded-md focus:outline-none focus:ring-4 focus:ring-blue-300 duration-300">
                                        Room Details
                                    </button>
                
                                    @include('components.room-details')
                                </div>
                
                                {{-- Tombol Select --}}
                                <button 
                                    class="py-2 px-6 rounded-md 
                                    {{ $roomType->available_rooms_count > 0 ? 'bg-rose-700 hover:bg-rose-800 text-white' : 'bg-gray-400 text-gray-700 cursor-not-allowed' }}" 
                                    {{ $roomType->available_rooms_count > 0 ? '' : 'disabled' }}>
                                    Select
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>       
            {{-- room section end --}}      
            
            
            
            <!-- Kontrol Kuantitas (Awalnya disembunyikan) -->
                                {{-- <div class="quantity-container hidden">
                                    <button id="decrement" class="p-2 bg-gray-300 hover:bg-gray-400 rounded">
                                        <i class="fa-solid fa-minus fa-sm"></i>
                                    </button>
                                    <span id="quantity" class="px-2">1</span>
                                    <button id="increment" class="p-2 bg-gray-300 hover:bg-gray-400 rounded">
                                        <i class="fa-solid fa-plus fa-sm"></i>
                                    </button>
                                </div> --}}