@extends('layouts/admin')

@section('title', 'Edit Tipe Kamar | Admin')

@section('content')

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md text-sm lg:text-xs">
    <h2 class="text-xl font-semibold space-y-2 pb-4 border-b border-gray-300">Edit Tipe Kamar</h2>
    <form action="{{ route('room-types.update', $roomType) }}" method="POST" enctype="multipart/form-data" class="my-4">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Kolom Kiri -->
            <div class="space-y-3">
                <!-- Tipe Kamar -->
                <div class="space-y-1">
                    <label for="tipe_kamar" class="block text-gray-700 font-medium">Tipe Kamar:</label>
                    <input type="text" id="tipe_kamar" name="tipe_kamar" value="{{ old('tipe_kamar', $roomType->tipe_kamar) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300" required>
                </div>
                
                <!-- Kapasitas dan Harga -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Kapasitas -->
                    <div class="space-y-1">
                        <label for="kapasitas" class="block text-gray-700 font-medium">Kapasitas:</label>
                        <input type="number" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $roomType->kapasitas) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300" required>
                    </div>
                    
                    <!-- Harga -->
                    <div class="space-y-1">
                        <label for="harga" class="block text-gray-700 font-medium">Harga:</label>
                        <input type="number" id="harga" name="harga" value="{{ old('harga', $roomType->harga) }}" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300" required>
                    </div>
                </div>
        
                <!-- Deskripsi Kamar -->
                <div class="space-y-1">
                    <label for="deskripsi_kamar" class="block text-gray-700 font-medium">Deskripsi Kamar:</label>
                    <textarea id="deskripsi_kamar" name="deskripsi_kamar" rows="3" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300" placeholder="Masukkan deskripsi kamar" required>{{ old('deskripsi_kamar', $roomType->deskripsi_kamar) }}</textarea>
                </div>
            </div>
        
            <!-- Kolom Kanan -->
            <div class="space-y-3">
                <!-- Fasilitas -->
                <div class="space-y-1">
                    <label for="fasilitas" class="block text-gray-700 font-medium">Fasilitas:</label>
                    <textarea id="fasilitas" name="fasilitas" rows="3" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-yellow-300" required>{{ old('fasilitas', $roomType->fasilitas) }}</textarea>
                </div>
                
                <!-- Foto Kamar -->
                <div class="space-y-1">
                    <label for="foto" class="block text-gray-700 font-medium">Foto Kamar:</label>
                    <input type="file" id="foto" name="foto[]" class="w-full border p-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300" multiple>
                    <small class="text-gray-500">Kosongkan jika tidak ingin mengubah foto.</small>
                </div>
            </div>
        </div>
        
        <!-- Tombol Aksi -->
        <div class="flex justify-end mt-12">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-yellow-300">Perbarui Tipe Kamar</button>
        </div>
    </form>
</div>

@endsection
