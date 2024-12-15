<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'reservation_id',
        'service_id',
        'price',
        'total_price',
        'status_order',
    ];

    // Relasi ke model Reservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // Relasi ke model Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Event Eloquent untuk menetapkan default status_order ke unpaid
    protected static function booted()
    {
        static::creating(function ($serviceOrder) {
            if (is_null($serviceOrder->status_order)) {
                $serviceOrder->status_order = 'unpaid';
            }
        });
    }
}
