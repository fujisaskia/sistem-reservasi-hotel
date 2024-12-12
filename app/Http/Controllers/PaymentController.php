<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Midtrans\Config;
use Midtrans\Snap;
use Auth;
use Log;
use Midtrans\Transaction;


class PaymentController extends Controller
{
    public function getSnapToken(Request $request)
    {
        $reservation = Reservation::findOrFail($request->reservation_id);
    
        // Ambil data invoice terkait dengan reservasi
        $invoice = $reservation->invoice;
    
        // Jika invoice tidak ditemukan, buat ID order tanpa nomor invoice
        $invoiceNumber = $invoice ? $invoice->invoice_number : 'INV-UNKNOWN';
    
        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    
        // Buat order ID dengan mencantumkan nomor invoice
        $orderId = 'ByHotel/BOOKING-' . $invoiceNumber . '-' . uniqid();
        $grossAmount = $reservation->total_price;
    
        // Data untuk Snap
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $reservation->user->full_name,
                'email' => $reservation->user->email,
                'phone' => $reservation->user->phone_number,
            ],
        ];
    
        // Dapatkan Snap Token
        $snapToken = \Midtrans\Snap::getSnapToken($params);
    
        // Simpan pembayaran dengan status pending
        Payment::create([
            'reservation_id' => $reservation->id,
            'order_id' => $orderId,
            'amount' => $grossAmount,
            'payment_status' => 'pending',
            'payment_method' => 'snap_midtrans', // Contoh metode pembayaran
            'payment_date' => now(),            // Tanggal pembayaran (saat ini)
        ]);
        
        return response()->json(['snapToken' => $snapToken]);
    }
    

    public function updatePaymentStatus(Request $request)
    {
        Log::info('Request masuk ke updatePaymentStatus', $request->all()); // Logging request
    
        $orderId = $request->input('order_id');
        $paymentStatus = $request->input('payment_status');
    
        $payment = Payment::where('order_id', $orderId)->first();
    
        if (!$payment) {
            Log::error('Transaksi tidak ditemukan', ['order_id' => $orderId]);
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }
    
        if ($paymentStatus === 'success') {
            $payment->payment_status = 'success';
            $payment->save();
    
            Log::info('Status pembayaran berhasil diperbarui', ['order_id' => $orderId]);
    
            return response()->json([
                'message' => 'Status pembayaran berhasil diperbarui.',
                'payment' => $payment,
            ]);
        }
    
        Log::warning('Status pembayaran tidak valid', $request->all());
        return response()->json([
            'message' => 'Status pembayaran tidak valid atau tidak diperbarui.',
        ], 400);
    }
    

}
