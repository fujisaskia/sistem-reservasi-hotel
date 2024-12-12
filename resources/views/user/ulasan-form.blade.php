@extends('layouts.user')

@section('content')
<div class="max-w-6xl mx-auto text-sm lg:text-xs p-6 md:p-12 lg:p-0">
    
    @if(session('success'))
    <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
            });
        </script>
    @endif


    <div class="flex gap-4">
        
        <x-menu-profile></x-menu-profile>
        <div class="w-full">
            
            <!-- Form Ulasan -->
            <form action="{{ route('ulasan.store') }}" method="POST" class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded-md">
                @csrf
                <h1 class="text-2xl font-bold mb-6">Beri Ulasan</h1>
        
                <div class="mb-4">
                    <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                    <select name="rating" id="rating" class="w-full mt-1 p-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-yellow-100" required>
                        <option value="" disabled selected>Pilih rating</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    @error('rating')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700">Komentar</label>
                    <textarea name="comment" id="comment" rows="4" class="w-full mt-1 p-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-yellow-100"></textarea>
                    @error('comment')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 w-1/3 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">Kirim Ulasan</button>
                </div>
            </form>
        </div>
</div>
@endsection
