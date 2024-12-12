<?php

// HotelSetting.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelSetting extends Model
{
    protected $fillable = [        
        'name',
        'description',
        'logo_path',
        'address',
        'email',
        'phone',
        'instagram',
        'facebook',
        'tiktok',
        'whatsapp',
    ];

    public function photos()
    {
        return $this->hasMany(HotelPhoto::class, 'hotel_setting_id'); // Sesuaikan nama kolom foreign key
    }
}

