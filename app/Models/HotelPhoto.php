<?php

// HotelPhoto.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelPhoto extends Model
{
    protected $fillable = ['hotel_setting_id', 'photo_path'];
    
    public function hotelSetting()
    {
        return $this->belongsTo(HotelSetting::class, 'hotel_setting_id'); // Sesuaikan nama kolom foreign key
    }
}

