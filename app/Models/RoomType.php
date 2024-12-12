<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe_kamar',
        'kapasitas',
        'harga',
        'deskripsi_kamar',
        'fasilitas',
        'foto', // Menyimpan foto dalam format JSON
    ];
    
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
