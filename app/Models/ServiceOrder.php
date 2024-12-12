<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    public $timestamps = true; // Pastikan ini aktif

    protected $fillable = [
        'reservation_id',
        'service_id',
        'quantity',
        'price',
        'total_price',
        'order_date',
        'notes',
    ];

    // Relasi ke model Reservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // Relasi ke model Layanan
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
