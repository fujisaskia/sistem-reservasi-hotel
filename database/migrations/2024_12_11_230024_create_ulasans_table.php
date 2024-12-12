<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke users
            $table->tinyInteger('rating')->unsigned(); // Nilai rating 1-5
            $table->text('comment')->nullable(); // Komentar
            $table->boolean('is_visible')->default(true); // Kolom visibilitas ulasan (default true)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
};
