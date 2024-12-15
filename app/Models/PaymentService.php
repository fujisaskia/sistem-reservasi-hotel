<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentService extends Model
{
    protected $fillable = [
        'reservation_id',   // ID reservasi yang terkait
        'order_id',         // ID unik dari Midtrans
        'amount',           // Jumlah pembayaran
        'payment_status',   // Status pembayaran
        'payment_method',   // Metode pembayaran
        'payment_date',     // Waktu pembayaran
    ];

    /**
     * Tipe kolom yang harus di-cast ke format tertentu.
     */
    protected $casts = [
        'payment_date' => 'datetime', // Konversi otomatis ke objek Carbon
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
}
