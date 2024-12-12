<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Invoice;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class ReceptionistController extends Controller
{
    public function index(Request $request)
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
    
        return view('receptionist.reservasi', compact('reservations'));
    }
    
    
    //resepsionist mengonfirmasi reservasi user
    public function confirmReservation($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Periksa apakah status reservasi saat ini adalah 'pending'
        if ($reservation->reservation_status === 'Pending') {
            $reservation->reservation_status = 'Confirmed';
            $reservation->save();

            // Ambil nama lengkap user yang terkait dengan reservasi
            $userName = $reservation->user ? $reservation->user->full_name : 'Nama user tidak tersedia';

            // Set session dengan nama user dalam tag <strong> untuk membuatnya tebal
            return redirect()->back()->with('status', 'Reservasi oleh <strong>' . $userName . '</strong> berhasil dikonfirmasi!');
        } else {
            // Jika status tidak 'pending', kembalikan ke halaman sebelumnya dengan pesan kesalahan
            return redirect()->back()->with('error', 'Reservasi tidak dapat dikonfirmasi, mohon periksa status reservasi terlebih dahulu.');
        }
    }

    
    //menampilkan data kamar yang "tersedia" di fitur check-in
    public function showAvailableRooms()
    {
        $availableRooms = Room::with('roomType')->where('room_status', 'tersedia')->get();
        return view('receptionist.check-in', compact('availableRooms'));
    }

    //mengirim data untuk form check-in
    public function showCheckInForm($id)
    {
        // Ambil detail kamar berdasarkan ID
        $room = Room::with('roomType')->findOrFail($id);
    
        // Ambil reservasi yang pending
        $reservations = Reservation::where('reservation_status', 'Confirmed')->get();
        $invoices = Invoice::whereIn('reservation_id', $reservations->pluck('id'))->get();
    
        // Tampilkan form check-in dengan data kamar dan reservasi
        return view('receptionist.in-room', compact('room', 'reservations', 'invoices'));
    }

    //melakukan proses check-in dan mengubah status
    public function processCheckIn(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
        ]);
    
        // Ambil data kamar berdasarkan ID
        $room = Room::findOrFail($id);
    
        // Periksa apakah kamar tersedia
        if ($room->room_status !== 'tersedia') {
            return redirect()->back()->withErrors(['error' => 'Kamar tidak tersedia untuk check-in.']);
        }
    
        // Ambil reservasi berdasarkan ID
        $reservation = Reservation::where('id', $validatedData['reservation_id'])
            ->where('reservation_status', 'Confirmed')
            ->first();
    
        // Periksa apakah reservasi valid
        if (!$reservation) {
            return redirect()->back()->withErrors(['error' => 'Reservasi tidak valid atau sudah di-check-in.']);
        }
    
        // Proses check-in: update status kamar dan reservasi
        try {
            DB::transaction(function () use ($room, $reservation) {
                // Update status kamar
                $room->update(['room_status' => 'terisi']);
    
                // Update status reservasi
                $reservation->update([
                    'room_id' => $room->id,
                    'reservation_status' => 'Checked-In',
                ]);
            });
    
            // Redirect dengan pesan sukses
            return redirect()->route('receptionist.dashboard')->with('success', 'Check-in berhasil!');
        } catch (\Exception $e) {
            // Tangani error jika ada kegagalan dalam proses transaksi
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memproses check-in. Silakan coba lagi.']);
        }
    }

    //menampilkan data kamar yang "terisi" di fitur check-in
    public function showOccupiedRooms()
    {
        // Mengambil kamar yang berstatus "terisi"
        $occupiedRooms = Room::with('roomType')->where('room_status', 'terisi')->get();

        // Passing data ke view
        return view('receptionist.check-out', compact('occupiedRooms'));
    }    

    public function showCheckOutForm($id)
    {
        // Ambil detail kamar berdasarkan ID
        $room = Room::with('roomType')->findOrFail($id);
    
        // Ambil data reservasi aktif berdasarkan ID kamar
        $reservation = Reservation::with(['serviceOrders', 'payment', 'invoice'])
            ->where('room_id', $id)
            ->where('reservation_status', '!=', 'Checked-Out') // Pastikan reservasi belum check-out
            ->firstOrFail();

            // Hitung selisih hari antara check-in dan check-out
        $checkInDate = Carbon::parse($reservation->check_in_date);
        $checkOutDate = Carbon::parse($reservation->check_out_date);
        $nights = $checkInDate->diffInDays($checkOutDate);
    
        // Hitung total pembayaran reservasi kamar
        $roomPaymentTotal = $reservation->payment->amount;
    
        // Hitung total biaya service orders
        $serviceOrderTotal = $reservation->serviceOrders->sum('total_price');
    
        // Hitung total keseluruhan
        $grandTotal = $roomPaymentTotal + $serviceOrderTotal;
    
        // Kirim data ke view
        return view('receptionist.out-room', compact('room', 'reservation', 'roomPaymentTotal', 'serviceOrderTotal', 'grandTotal', 'nights'));
    }
    
    public function processCheckOut($id)
    {
        DB::beginTransaction(); // Mulai transaksi untuk memastikan perubahan dilakukan secara atomik
    
        try {
            // Ambil reservasi berdasarkan ID
            $reservation = Reservation::with(['room', 'serviceOrders', 'invoice'])->findOrFail($id);
    
            // Ubah status kamar menjadi "perawatan"
            $reservation->room->update(['room_status' => 'perawatan']);
    
            // Ubah status reservasi menjadi "Checked-Out"
            $reservation->update(['reservation_status' => 'Checked-Out']);
    
            // Hitung total biaya layanan
            $serviceOrderTotal = $reservation->serviceOrders->sum('total_price');
    
            // Tambahkan total biaya layanan ke kolom amount pada tabel invoice
            $reservation->invoice->update([
                'total_amount' => $reservation->invoice->total_amount + $serviceOrderTotal,
            ]);
    
            DB::commit(); // Komit perubahan
            return redirect()->route('check-out.index')->with('success', 'Check-Out berhasil diproses.');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika terjadi kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses check-out.');
        }
    }
    

    //menampilkan user yang sudah check-in ke fitur tamu receptionist
    public function showCheckedInReservations()
    {
        // Query untuk mendapatkan data reservasi dengan status 'checked-in'
        $reservations = Reservation::where('reservation_status', 'checked-in')->with('room')->get();

        // Kirim data ke view
        return view('receptionist.guest', compact('reservations'));
    }
    
    public function showRoomsData()
    {
        $rooms = Room::with('roomType')->get(); // Load relasi tipe kamar
        return view('receptionist.rooms', compact('rooms'));
    }

    public function editRoomStatus($id)
    {
        $room = Room::findOrFail($id);
        return view('receptionist.edit-room', compact('room'));
    }

    public function updateRoomStatus(Request $request, $id)
    {
        $request->validate([
            'room_status' => 'required|in:tersedia,terisi,perawatan',
        ]);
        
        $room = Room::findOrFail($id);
        $room->room_status = $request->input('room_status');
        $room->save();

        return redirect()->route('receptionist.rooms.index', $room->id)->with('success', 'Status kamar berhasil diperbarui');
    }

    public function printInvoice($id)
    {
        $reservation = Reservation::with(['roomType', 'payment', 'serviceOrders.service'])
            ->findOrFail($id);
    
        $checkInDate = Carbon::parse($reservation->check_in_date);
        $checkOutDate = Carbon::parse($reservation->check_out_date);
        $nights = $checkInDate->diffInDays($checkOutDate);
        $serviceOrderTotal = $reservation->serviceOrders->sum('total_price');
        $grandTotal = $reservation->payment->amount + $serviceOrderTotal;
    
        $data = [
            'reservation' => $reservation,
            'nights' => $nights,
            'serviceOrderTotal' => $serviceOrderTotal,
            'grandTotal' => $grandTotal,
        ];
    
        $pdf = Pdf::loadView('print.invoice', $data);
        return $pdf->download('invoice.pdf');
    }
    
}
