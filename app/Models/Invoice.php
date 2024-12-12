<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // Nama tabel (opsional, jika nama tabel berbeda dari 'invoices')
    protected $table = 'invoices';

    // Primary key (opsional, jika bukan 'id')
    protected $primaryKey = 'invoice_id';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'reservation_id',
        'invoice_number',
        'total_amount',
        'invoice_date',
        'due_date',
    ];

    // Relasi ke tabel reservations (One-to-One)
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
    }
    
}
