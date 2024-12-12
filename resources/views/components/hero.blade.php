
<div id="default-carousel" class="relative w-full">
    <!-- Carousel wrapper -->
    <div class="max-w-6xl mx-auto relative h-80 overflow-hidden md:h-[500px] rounded-b-3xl">
        @if ($hotelSetting && $hotelSetting->photos->count() > 0)
        @foreach ($hotelSetting->photos as $photo)
            <div class="carousel-item duration-700 ease-in-out opacity-0" data-carousel-item>
                <img src="{{ asset('storage/' . $photo->photo_path) }}" 
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 rounded-b-3xl" 
                    alt="Hotel Photo">
            </div>
        @endforeach
        @else
            <p>No photos available.</p>
        @endif

    </div>
    <!-- Slider indicators -->
    <div class="absolute flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="indicator w-3 h-3 rounded-full bg-white/50" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="indicator w-3 h-3 rounded-full bg-white/50" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="indicator w-3 h-3 rounded-full bg-white/50" aria-label="Slide 3" data-carousel-slide-to="2"></button>
    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-300 hover:bg-gray-400 group-focus:ring-2 group-focus:ring-white">
            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-300 hover:bg-gray-400 group-focus:ring-2 group-focus:ring-white">
            <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carouselItems = document.querySelectorAll('.carousel-item');
        const indicators = document.querySelectorAll('.indicator');
        const prevButton = document.querySelector('[data-carousel-prev]');
        const nextButton = document.querySelector('[data-carousel-next]');
        let currentIndex = 0;

        function updateSlide() {
            carouselItems.forEach((item, index) => {
                item.classList.add('opacity-0');
                indicators[index].classList.remove('bg-white'); // Reset indicator color
                indicators[index].classList.add('bg-white/50'); // Default color
            });
            
            carouselItems[currentIndex].classList.remove('opacity-0'); // Show current slide
            indicators[currentIndex].classList.add('bg-white');  // Active indicator color
        }

        // Auto-slide every 3 seconds
        let autoSlide = setInterval(nextSlide, 3000);

        function nextSlide() {
            currentIndex = (currentIndex + 1) % carouselItems.length;
            updateSlide();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
            updateSlide();
        }

        // Click event for indicators
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentIndex = index;
                updateSlide();
                resetAutoSlide();
            });
        });

        // Event listeners for prev and next buttons
        prevButton.addEventListener('click', () => {
            prevSlide();
            resetAutoSlide();
        });

        nextButton.addEventListener('click', () => {
            nextSlide();
            resetAutoSlide();
        });

        // Reset auto-slide on manual interaction
        function resetAutoSlide() {
            clearInterval(autoSlide);
            autoSlide = setInterval(nextSlide, 3000);
        }
    });
</script>

<style>
.carousel-item {
    opacity: 0;
    transition: opacity 0.5s ease-in-out; /* Smooth transition */
}
.carousel-item:not(.opacity-0) {
    opacity: 1;
}
</style>
