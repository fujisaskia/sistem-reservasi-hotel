<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Service;
use App\Models\Reservation;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use Barryvdh\DomPDF\Facade\Pdf;


class ServiceOrderController extends Controller
{
    // Menampilkan form input layanan
    public function showForm(Reservation $reservation, Request $request)
    {
        $categories = ServiceCategory::all();
        $selectedCategory = $request->get('category_id');
        $services = $selectedCategory
            ? Service::where('service_category_id', $selectedCategory)->get()
            : Service::all();
    
        $serviceOrders = ServiceOrder::where('reservation_id', $reservation->id)
            ->where('status_order', 'unpaid')
            ->get();
    
        $totalAmount = $serviceOrders->isNotEmpty()
            ? $serviceOrders->sum('price')
            : 0;
    
        $invoice = $reservation->invoice;
    
        return view('receptionist.layanan-kamar', compact(
            'reservation', 
            'categories', 
            'services', 
            'invoice', 
            'serviceOrders', 
            'totalAmount'
        ));
    }
    
    //menambah service order
    public function addServiceOrder(Request $request)
    {
        $serviceOrders = ServiceOrder::create([
            'reservation_id' => $request->reservation_id,
            'service_id' => $request->service_id,
            'price' => $request->price,
            'total_price' => $request->price, // Or calculate based on quantity if needed
        ]);

        // Return the updated service orders
        $serviceOrders = ServiceOrder::where('reservation_id', $request->reservation_id)->get();

        return response()->json([
            'success' => true,
            'serviceOrders' => $serviceOrders
        ]);
    }
    
    

    public function showReservationSummary($reservationId)
    {
        $reservationId = Reservation::with('room', 'user')->findOrFail($reservationId);
        $serviceOrders = ServiceOrder::where('reservation_id', $reservationId)
            ->where('status_order', 'unpaid')
            ->get();
    
        // $totalAmount = $serviceOrders->sum('total_price');
    
        return response()->json([
            'orders' => $serviceOrders
        ]);
    }


    /**
     * Menampilkan daftar layanan berdasarkan reservation.
     */
    public function showServiceByReservation($reservationId)
    {
        // Ambil data reservation berdasarkan ID
        $reservation = Reservation::find($reservationId);
        // Ambil invoice terkait dengan reservasi
        $invoice = $reservation->invoice; // Menggunakan relasi untuk mengambil data invoice

        if (!$reservation) {
            return redirect()->back()->with('error', 'Reservation tidak ditemukan.');
        }

        // Ambil data service orders yang terkait dengan reservation
        $serviceOrder = ServiceOrder::where('reservation_id', $reservation->id)
            ->where('status_order', 'paid')
            ->get();

        // Hitung total harga
        $totalHarga = $serviceOrder->sum('total_price');

        // Kirim data ke view
        return view('receptionist.detail-layanan', [
            'reservation' => $reservation,
            'invoice' => $invoice,
            'serviceOrder' => $serviceOrder,
            'totalHarga' => $totalHarga,
        ]);
    }

    public function deleteService(Request $request)
    {
        $orderId = $request->input('order_id');
        ServiceOrder::where('id', $orderId)->delete();
        return response()->json(['message' => 'Layanan berhasil dihapus!']);
    }


    public function printSelectedServices(Request $request)
    {
        // Validasi bahwa service_ids ada dalam request dan merupakan array
        $request->validate([
            'service_ids' => 'required|array|min:1',
            'service_ids.*' => 'exists:service_orders,id', // Pastikan ID layanan valid
        ]);

        // Ambil ID layanan yang dipilih dari permintaan
        $serviceIds = $request->input('service_ids');

        // Ambil data layanan yang sesuai dengan ID yang dipilih, dengan relasi terkait
        $services = ServiceOrder::whereIn('id', $serviceIds)
            ->with(['service', 'reservation.user', 'reservation.room']) // Pastikan relasi terkait diambil
            ->get();

        if ($services->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada layanan yang dipilih.');
        }

        // Ambil data reservasi yang terkait dengan layanan
        $reservations = $services->map(function ($service) {
            return $service->reservation; // Mengambil data reservasi terkait dari setiap layanan
        })->unique();

        // Hitung total harga dari layanan yang dipilih
        $totalHarga = $services->sum('total_price');

        // Generate PDF menggunakan view yang sudah disesuaikan
        $pdf = Pdf::loadView('print.layanan-kamar', [
            'services' => $services,
            'reservations' => $reservations,
            'totalHarga' => $totalHarga,
        ])->setPaper('a4', 'portrait');

        // Unduh PDF
        return $pdf->download('layanan-kamar.pdf');
    }


    public function getOrderDetails($id)
    {
        $order = ServiceOrder::findOrFail($id);

        // Kembalikan data order sebagai response JSON
        return response()->json([
            'date' => $order->created_at->format('d F Y'),
            'service' => $order->service,
            'price' => $order->price,
            'quantity' => $order->quantity,
            'total_price' => $order->total_price,
            'notes' => $order->notes ?? 'Tidak ada tambahan',
        ]);
    }
}
