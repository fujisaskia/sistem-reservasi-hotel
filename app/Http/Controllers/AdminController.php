<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Reservation;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    // Fungsi untuk menghitung jumlah reservasi berdasarkan status pembayaran dan status reservasi di Admin
    public function index(Request $request)
    {
        // Hitung total reservasi dengan status pembayaran success

        // Hitung total reservasi dengan status pembayaran success berdasarkan bulan ini
        $totalPaymentSuccess = Reservation::whereHas('payment', function ($query) {
            $query->where('payment_status', 'success');
        })
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->count();
        

        // Hitung total reservasi dengan status reservasi confirmed
        $totalConfirmed = Reservation::where('reservation_status', 'Confirmed')->count();

        // Hitung total reservasi dengan status reservasi pending
        $totalPending = Reservation::where('reservation_status', 'Pending')->count();

        // Hitung total reservasi dengan status reservasi cancelled
        $totalCancelled = Reservation::where('reservation_status', 'Cancelled')->count();

        return view('admin.dashboard', compact('totalPaymentSuccess', 'totalConfirmed', 'totalPending', 'totalCancelled'));
    }


    public function adminReservations(Request $request)
    {
        $query = Reservation::with(['invoice', 'payment'])
            ->whereHas('payment', function ($query) {
                $query->where('payment_status', 'success');
            });
    
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('reservation_status', $request->status);
        }
    
        // Pencarian berdasarkan nama atau nomor invoice
        if ($request->filled('search')) {
            $query->where(function ($query) use ($request) {
                $query->whereHas('user', function ($userQuery) use ($request) {
                    $userQuery->where('full_name', 'like', '%' . $request->search . '%');
                })->orWhereHas('invoice', function ($invoiceQuery) use ($request) {
                    $invoiceQuery->where('invoice_number', 'like', '%' . $request->search . '%');
                });
            });
        }
    
        // Urutkan berdasarkan status "Checked-Out" di bawah
        $reservations = $query->orderByRaw("CASE WHEN reservation_status = 'Checked-Out' THEN 1 ELSE 0 END")
            ->paginate(10);

        return view('admin.reservasi', compact('reservations'));
    }


    public function filter(Request $request)
    {
        $query = Reservation::with(['user', 'roomType']);
    
        if ($request->status) {
            $query->where('reservation_status', $request->status);
        }
        if ($request->bulan) {
            $query->whereMonth('created_at', $request->bulan);
        }
        if ($request->tahun) {
            $query->whereYear('created_at', $request->tahun);
        }
    
        $reservations = $query->get();
    
        return response()->json($reservations);
    }
    
    public function cetakLaporan(Request $request)
    {
        $request->validate([
            'status' => 'nullable|in:Pending,Confirmed,Checked-In,Checked-Out,Cancelled',
            'bulan' => 'nullable|integer|min:1|max:12',
            'tahun' => 'nullable|integer|min:2020|max:' . date('Y'),
        ]);
    
        $query = Reservation::with(['invoice', 'payment']);
    
        if ($request->status) {
            $query->where('reservation_status', $request->status);
        }
        if ($request->bulan) {
            $query->whereMonth('created_at', $request->bulan);
        }
        if ($request->tahun) {
            $query->whereYear('created_at', $request->tahun);
        }
    
        $reservations = $query->get();
    
        // Cetak PDF
        $pdf = Pdf::loadView('print.reservasi-laporan', [
            'reservations' => $reservations,
            'status' => $request->status,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);
        return $pdf->download('laporan-reservasi.pdf');
    }

        //menampilkan user yang sudah check-in ke fitur tamu receptionist
        public function showGuest()
        {
            // Query untuk mendapatkan data reservasi dengan status 'checked-in'
            $reservations = Reservation::where('reservation_status', 'checked-in')->with('room')->get();
    
            // Kirim data ke view
            return view('admin.guest', compact('reservations'));
        }


    /**
     * Menampilkan daftar layanan berdasarkan reservation.
     */
    public function showServiceRoomByReservation($reservationId)
    {
        // Ambil data reservation berdasarkan ID
        $reservation = Reservation::find($reservationId);
        // Ambil invoice terkait dengan reservasi
        $invoice = $reservation->invoice; // Menggunakan relasi untuk mengambil data invoice

        if (!$reservation) {
            return redirect()->back()->with('error', 'Reservation tidak ditemukan.');
        }

        // Ambil data service orders yang terkait dengan reservation
        $services = ServiceOrder::where('reservation_id', $reservation->id)
            ->with('service') // Pastikan relasi ke tabel 'services' sudah didefinisikan di model ServiceOrder
            ->get();

        // Hitung total harga
        $totalHarga = $services->sum('total_price');

        // Kirim data ke view
        return view('admin.detail-layanan', [
            'reservation' => $reservation,
            'invoice' => $invoice,
            'services' => $services,
            'totalHarga' => $totalHarga,
        ]);
    }

    

}
