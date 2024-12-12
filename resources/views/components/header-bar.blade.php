    <!-- Navbar -->
    <header class="nav fixed top-0 left-0 right-0 bg-white shadow-sm p-3">
        <div class="flex justify-between items-center md:ml-56">
            <div class="flex items-center space-x-4">
                <button class="flex lg:hidden rounded-lg p-1 text-slate-900 ml-3 lg:ml-0 active:bg-white focus:outline-none focus:ring focus:ring-rose-300" id="menu-button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                    </svg>                  
                </button>
                {{-- <h3 class="text-md text-center items-center justify-center font-bold ">@yield('title')</h3>             --}}
            </div>

            <!-- Profile Icon with Dropdown using Alpine.js -->
            <div x-data="{ openProfile: false }" class="relative">
                <a href="#" @click="openProfile = !openProfile" class="flex items-center ml-auto space-x-2">
                    <p class="text-sm md:text-md">{{ Auth::user()->full_name }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 rounded-full text-gray-400 border-gray-300">
                        <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                    </svg>
                </a>
                <!-- Dropdown Menu -->
                <div x-show="openProfile" @click.away="openProfile = false" x-cloak
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95" 
                    x-transition:enter-end="opacity-100 transform scale-100" 
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform scale-100" 
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="absolute right-0 mt-2 w-48 bg-white border-2 border-gray-100 rounded-lg shadow-lg">
                    <a href="#" class="flex items-center space-x-2 font-semibold px-4 py-3 text-sm lg:text-xs text-gray-700 hover:bg-gray-100">
                        <i class="fa-regular fa-user"></i>
                        <p>Profile</p>
                    </a>
                    <div x-data="{ showModal: false }" class="">
                        <button @click="showModal = true" class="flex w-full items-center space-x-2 font-semibold px-4 py-3 text-sm lg:text-xs text-rose-600 hover:text-white  hover:bg-rose-600 focus:bg-rose-500 rounded-b-lg duration-300">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <p>Keluar</p>
                        </button>

                        <!-- Popup Konfirmasi -->
                        <div x-show="showModal" class="fixed inset-0 flex items-center justify-center text-xs bg-gray-900 bg-opacity-50 z-50 px-4">
                            <div class="bg-white w-full md:w-1/3 p-6 rounded shadow-lg">
                                <h2 class="text-lg font-bold mb-4">Konfirmasi Logout</h2>
                                <p class="mb-6">Apakah Anda yakin ingin keluar?</p>
                                <div class="flex justify-end space-x-4">
                                    <button 
                                        @click="showModal = false" 
                                        class="bg-gray-300 px-4 py-2 rounded"
                                    >
                                        Batal
                                    </button>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

