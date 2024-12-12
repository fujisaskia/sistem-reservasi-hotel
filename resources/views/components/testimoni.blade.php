<!-- Testimonial Section -->
<section id="testimonials" class="py-16 bg-gray-200 text-sm md:text-xs px-4">
    <div class="max-w-6xl mx-4 lg:mx-auto">
        <div class="text-center space-y-4 mb-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 font-playfair">What Our Guests Say</h2>
            <div class="border-t-2 border-rose-500 mt-2 w-16 mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 ">
            @foreach ($ulasans as $ulasan)           
            <!-- Testimonial 1 -->
            <div class="bg-white p-4 rounded-lg shadow-xl text-center space-y-3 group hover:-translate-y-1 duration-300">
                <div class="flex items-start text-start space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-10">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z" clip-rule="evenodd" />
                    </svg>
                    <div class="flex-1">
                        <h3 class="text-xs font-bold group-hover:text-red-900">{{ $ulasan->user->full_name }}</h3>
                        <div class="flex items-center text-yellow-500">
                            <span class="flex text-yellow-500 text-lg">
                                {{ $ulasan->formattedRating() }}
                            </span>
                        </div>
                    </div>                              
                </div>
                <!-- Tag q dengan kelas tambahan untuk memastikan perataan kiri yang konsisten -->
                <q class="text-left block text-[11px] text-gray-600">{{ $ulasan->comment }}</q>
            </div>
            @endforeach
        </div>
    </div>
</section>

