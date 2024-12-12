<!-- Recommendation Rooms Section -->
<section id="rooms" class="py-16 bg-gray-100" x-data="slider()">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Recommendation Rooms</h2>
        <div class="relative overflow-hidden">
            <div class="flex transition-transform duration-500" :style="'transform: translateX(-' + (currentIndex * 100) + '%)'">
                <template x-for="(room, index) in rooms" :key="index">
                    <div class="min-w-full">
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-500">
                            <div class="grid grid-cols-1 lg:grid-cols-2 items-center text-sm">
                                <img :src="room.image" alt="Room" class="w-full h-full object-cover">
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold text-gray-800" x-text="room.title"></h3>
                                    <p class="text-gray-600 mb-4" x-text="room.description"></p>
                                    <span class="text-orange-600 font-bold" x-text="room.price"></span>
                                    <a href="#" class="mt-4 inline-block bg-orange-600 text-white py-2 px-4 rounded hover:bg-orange-500">Book Now</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </template>
            </div>

            <!-- Navigation Buttons -->
            <button @click="prev" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-orange-600 text-white p-2 rounded hover:bg-orange-500">
                &#10094; <!-- Arrow Left -->
            </button>
            <button @click="next" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-orange-600 text-white p-2 rounded hover:bg-orange-500">
                &#10095; <!-- Arrow Right -->
            </button>
        </div>
        
        <!-- Dots Navigation -->
        <div class="flex justify-center mt-4">
            <template x-for="(room, index) in rooms" :key="index">
                <button :class="currentIndex === index ? 'bg-orange-600' : 'bg-gray-300'" @click="currentIndex = index" class="w-3 h-3 mx-1 rounded-full"></button>
            </template>
        </div>
    </div>
</section>

<script>
    function slider() {
        return {
            rooms: [
                {
                    title: "Deluxe Room",
                    description: "Enjoy a spacious room with a beautiful view and modern amenities.",
                    price: "$150/night",
                    image: "{{ asset ('assets/deluxe.jpg') }}"
                },
                {
                    title: "Executive Suite",
                    description: "Experience luxury and comfort in our executive suite with top-notch facilities.",
                    price: "$250/night",
                    image: "{{ asset ('assets/suite.jpg') }}"
                },
                {
                    title: "Family Suite",
                    description: "Perfect for families, our family suite offers ample space and comfort.",
                    price: "$200/night",
                    image: "{{ asset ('assets/living.jpg') }}"
                },
                {
                    title: "Romantic Getaway",
                    description: "A cozy room ideal for couples, complete with romantic decor.",
                    price: "$180/night",
                    image: "{{ asset ('assets/deluxe.jpg') }}"
                },
            ],
            currentIndex: 0,
            next() {
                this.currentIndex = (this.currentIndex + 1) % this.rooms.length;
            },
            prev() {
                this.currentIndex = (this.currentIndex - 1 + this.rooms.length) % this.rooms.length;
            }
        };
    }
</script>
