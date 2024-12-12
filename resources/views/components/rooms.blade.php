{{-- <div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg flex flex-col lg:flex-row items-center justify-center lg:space-x-6 w-full max-w-6xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Text Section -->
            <div class="text-sm lg:text-xs">
                <h2 class="text-2xl font-bold mb-2">Superior</h2>
                <p class="text-gray-700 mb-4">The 26 sqm Superior Room with queen or twin bed is furnished with a classic-modern art offering comfort, equipped with hot & cold water standing shower, 42" LED TV, free high-speed Wi-Fi access, a...</p>
                <p class="text-gray-800 font-semibold">Tonight's rate: <span class="text-2xl font-bold">539,000</span></p>
                
                <div class="mt-4 space-x-4">
                    <button class="px-4 py-2 border border-yellow-500 text-yellow-500 font-semibold hover:bg-yellow-100">Discover</button>
                    <button class="px-4 py-2 bg-yellow-500 text-white font-semibold hover:bg-yellow-600">Book This Room</button>
                </div>
            </div>
    
            <!-- Image Slider Section -->
            <div class="mt-6 lg:mt-0" x-data="{ currentSlide: 0, images: ['{https://via.placeholder.com/600x400}', 'https://via.placeholder.com/600x400?text=Image+2', 'https://via.placeholder.com/600x400?text=Image+3'] }">
                <div class="relative w-full h-72 rounded-lg overflow-hidden">
                    <!-- Images -->
                    <template x-for="(image, index) in images" :key="index">
                        <img :src="image" alt="Room Image" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500"
                             x-show="currentSlide === index">
                    </template>
    
                    <!-- Navigation Buttons -->
                    <button @click="currentSlide = (currentSlide > 0) ? currentSlide - 1 : images.length - 1"
                            class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-lg hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="currentSlide = (currentSlide < images.length - 1) ? currentSlide + 1 : 0"
                            class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-lg hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
    
                <!-- Indicators -->
                <div class="flex justify-center mt-4 space-x-2">
                    <template x-for="(image, index) in images" :key="index">
                        <div :class="{'bg-gray-800': currentSlide === index, 'bg-gray-400': currentSlide !== index}"
                             @click="currentSlide = index"
                             class="w-3 h-3 rounded-full cursor-pointer"></div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div> --}}