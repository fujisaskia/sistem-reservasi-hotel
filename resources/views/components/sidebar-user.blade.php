@include('components.header-bar')

    <!-- Sidebar and Content Wrapper -->
    <div class="flex"> <!-- Added padding top to account for the navbar height -->
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed w-60 lg:w-52 h-screen bg-white py-4 lg:py-4 px-4 shadow-lg z-10 transform -translate-x-full transition-transform duration-300 md:translate-x-0 md:block">
            <button id="close-button" class="block md:hidden mt-2 ml-auto border-2 border-blue-200 rounded-lg p-1 active:bg-white focus:outline-none focus:ring focus:ring-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="flex space-x-2 py-8 items-center bg-white rounded-lg">
                <img src="{{ asset ('assets/ruby-hotel.png')}}" alt="logo ruby hotel" class="w-24 mx-auto">          
            </div>
        

            <ul class="space-y-4 ">
                <a href="">
                    <li class="flex items-center space-x-3 text-rose-800 py-3 rounded-xl px-4 {{ Request::is('dashboard/receptionist') ? 'bg-rose-500 text-white' : 'hover:bg-slate-100 hover:text-red-800 ' }} group">
                        <i class="fa-solid fa-hotel"></i>
                        <p class="text-sm md:text-xs font-medium group-hover:translate-x-1 duration-500">Home</p>
                    </li>
                </a>
                
                 
                <a href="">
                    <li class="flex items-center space-x-3 text-rose-800 py-3 rounded-xl px-4 mt-2 {{ Request::is('reservasi') ? 'bg-rose-500 text-white' : 'hover:bg-slate-100 hover:text-red-800 ' }} group">
                        <i class="fa-solid fa-tags"></i>
                        <p class="text-sm md:text-xs font-medium group-hover:translate-x-1 duration-500">Reservasi</p>
                    </li>
                </a>
                 
                <a href="">
                    <li class="flex items-center space-x-3 text-rose-800 hover:bg-slate-100 py-3 rounded-xl px-4 hover:text-red-800 mt-2 group">
                        <i class="fa-solid fa-couch"></i>
                        <p class="text-sm md:text-xs font-medium group-hover:translate-x-1 duration-500">Tamu</p>
                    </li>
                </a>
                 
            </ul>
        
        </aside>

    </div>


    <!-- Modal Popup Konfirmasi Logout  -->
    <div id="confirmationLogout" class="fixed inset-0 z-50 items-center justify-center hidden bg-gray-800 bg-opacity-50 text-sm md:text-xs">
        <div class="bg-white py-6 px-12 rounded-lg shadow-lg">
            <p class="text-center text-gray-700">Yakin mau logout?</p>
            <div class="mt-4 flex justify-center gap-6">
                <button id="cancelLogout" class="bg-white text-green-500 border border-green-500 py-2 px-4 rounded-xl hover:bg-green-500 hover:text-white">Tidak</button>
                <button id="confirmLogout" class="bg-white border border-red-500 text-red-500 py-2 px-4 rounded-xl hover:bg-red-500 hover:text-white">Ya</button>
            </div>
        </div>
    </div>

    <!-- JavaScript sidebar-->
    <script>
                // sidebar //

        // Ambil elemen-elemen yang diperlukan
        const menuButton = document.getElementById('menu-button');
        const closeButton = document.getElementById('close-button');
        const sidebar = document.getElementById('sidebar');

        // Fungsi untuk menampilkan sidebar
        menuButton.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
        });

        // Fungsi untuk menyembunyikan sidebar
        closeButton.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });
    </script>