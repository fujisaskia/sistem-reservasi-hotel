<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentServiceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\ServiceCategoryController;

// Landing-Page
Route::get('/', [RoomTypeController::class, 'roomsuites']);

Route::get('/rooms', [RoomTypeController::class, 'roomsLandingPage'])->name('rooms');

// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::prefix('Admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', [AdminController::class, 'index']);
});
Route::middleware(['auth', 'role:receptionist'])->group(function () {
     Route::get('/dashboard/receptionist', [ReceptionistController::class, 'index']);
});
Route::prefix('User')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/offers', [UserController::class, 'index']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/hotel-settings', [HotelController::class, 'index'])->name('hotel-settings');
Route::post('/update', [HotelController::class, 'updateSettings'])->name('hotel-settings.update');

// Rute untuk Dashboard Admin
Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/monthly-revenue', [DashboardController::class, 'getMonthlyRevenue']);

// rute manajemen reservation/
Route::get('/admin/reservations', [AdminController::class, 'adminReservations'])->name('admin.reservations');
Route::get('/reservations/filter', [AdminController::class, 'filter'])->name('reservations.filter');
Route::get('/admin/reservasi/cetak', [AdminController::class, 'cetakLaporan'])->name('admin.reservasi.cetak');


// Rute untuk manajemen tipe kamar
Route::get('/room-type/admin', [RoomTypeController::class, 'index'])->name('room-types.index');
Route::get('/add-type', [RoomTypeController::class, 'create'])->name('room-types.create');
Route::post('/room-type/admin', [RoomTypeController::class, 'store'])->name('room-types.store');
Route::get('/edit-type/{roomType}/edit', [RoomTypeController::class, 'edit'])->name('room-types.edit');
Route::put('/room-type/admin/{roomType}', [RoomTypeController::class, 'update'])->name('room-types.update');
Route::delete('/room-type/{roomType}', [RoomTypeController::class, 'destroy'])->name('room-types.destroy');

// Rute untuk manajemen kamar
Route::get('/room-manage/admin', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/add-room/admin', [RoomController::class, 'create'])->name('rooms.create');
Route::post('/room-manage/admin', [RoomController::class, 'store'])->name('rooms.store');
Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');
Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');

// Rute untuk manajemen layanan
Route::get('/service/admin', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('/services/admin', [ServiceController::class, 'store'])->name('services.store');
Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

// Rute untuk manajemen Kategori layanan
Route::get('/service-category', [ServiceCategoryController::class, 'index'])->name('service_categories.index');
Route::get('/service-categoriecas/create', [ServiceCategoryController::class, 'create'])->name('service-categories.create');
Route::post('/service-category', [ServiceCategoryController::class, 'store'])->name('service-categories.store');
Route::get('/service-categories/{id}/edit', [ServiceCategoryController::class, 'edit'])->name('service-categories.edit');
Route::put('/service-categories/{id}', [ServiceCategoryController::class, 'update'])->name('service-categories.update');
Route::delete('/service-categories/{id}', [ServiceCategoryController::class, 'destroy'])->name('service-categories.destroy');

Route::get('/admin/guest', [AdminController::class, 'showGuest'])->name('guest.admin');
Route::get('/lihat-layanan/{reservation}', [AdminController::class, 'showServiceRoomByReservation'])->name('lihat-layanan');


Route::get('/users/admin', function () {
    return view('admin.users');
});

//rute untuk fitur Manajemen Ulasan
Route::get('/admin/ulasan', [UlasanController::class, 'index'])->name('ulasans.index');
Route::post('/admin/ulasans/toggle-visibility/{id}', [UlasanController::class, 'toggleVisibility'])->name('ulasans.toggleVisibility');


// rute dahboard resepsionis
Route::get('/dashboard/receptionist', [DashboardController::class, 'receptionistDashboard'])->name('receptionist.dashboard');

// Route untuk halaman index reservasi
Route::get('/reservasi', [ReceptionistController::class, 'index'])->name('reservasi.index');
Route::match(['get', 'post'], '/reservation/{id}/confirm', [ReceptionistController::class, 'confirmReservation'])
    ->name('reservation.confirm');


// menampilkan data kamar "tersedia" di fitur check-in
Route::get('/check-in/receptionist', [ReceptionistController::class, 'showAvailableRooms']);
Route::get('/check-in/in-room/{id}', [ReceptionistController::class, 'showCheckInForm'])->name('checkin.form');
// Route::get('/search-invoice', [ReceptionistController::class, 'search'])->name('invoice.search');
Route::post('/check-in/in-room/{id}', [ReceptionistController::class, 'processCheckIn'])->name('checkin.process');

// Route untuk halaman index Guedt
Route::get('/guest', [ReceptionistController::class, 'showCheckedInReservations'])->name('guest.checked_in');
Route::get('/layanan-kamar/{reservation}', [ServiceOrderController::class, 'showForm'])->name('layanan.form');
// Route::post('/layanan/create-order', [ServiceOrderController::class, 'createOrder'])->name('layanan.createOrder');
Route::get('/detail-layanan/{reservation}', [ServiceOrderController::class, 'showServiceByReservation'])->name('detail-layanan');
Route::post('/delete-service', [ServiceOrderController::class, 'deleteService']);
Route::post('/print-services', [ServiceOrderController::class, 'printSelectedServices'])->name('print.services');
Route::post('/service-orders', [ServiceOrderController::class, 'addServiceOrder'])->name('service-orders.add');
Route::get('/service-order/{reservationId}', [ServiceOrderController::class, 'showReservationSummary'])->name('service-order');


// menampilkan data kamar "Terisi" di fitur check-in
Route::get('/check-out', [ReceptionistController::class, 'showOccupiedRooms'])->name('check-out.index');
Route::get('/check-out/{id}', [ReceptionistController::class, 'showCheckOutForm'])->name('check-out.show');
Route::post('/checkout/{id}', [ReceptionistController::class, 'processCheckOut'])->name('checkout.process');
Route::get('/invoice/{id}/print', [ReceptionistController::class, 'printInvoice'])->name('invoice.print');

Route::get('/new-inroom', function () {
    return view('receptionist.new-inroom');
});
Route::get('/create-reservation', function () {
    return view('receptionist.create-reservation');
});
//rute fitur ketersediaan kamar
Route::get('/rooms/receptionist', [ReceptionistController::class, 'showRoomsData'])->name('receptionist.rooms.index');
Route::get('/rooms/receptionist/{id}/edit', [ReceptionistController::class, 'editRoomStatus'])->name('receptionist.rooms.edit');
Route::put('/rooms/receptionist/{id}', [ReceptionistController::class, 'updateRoomStatus'])->name('receptionist.rooms.update');

//rute fitur laporan
Route::get('/receptionist/reports', [ReportController::class, 'showReports'])->name('receptionist.reports');
Route::get('/reports/cetak', [ReportController::class, 'cetakLaporan'])->name('reports.cetak');
Route::get('/detail/report/{id}', [ReportController::class, 'showDetailLaporan'])->name('detail.report');

// Guest // User
Route::get('/offers', [UserController::class, 'index'])->name('user.offers');
Route::get('/profile', [ProfileController::class, 'edit'])->name('user.profile');
Route::put('/profile/edit', [ProfileController::class, 'update'])->name('user.profile.update');
Route::get('/my-booking', [UserController::class, 'showBookings'])->name('user.my-booking');
Route::get('/my-booking/details/{id}', [UserController::class, 'showBookingDetails'])->name('booking.details');
Route::get('/ulasan/form', [UlasanController::class, 'showForm'])->name('ulasan.form');
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');


Route::get('/booking/{id}', [UserController::class, 'showType'])->name('user.booking');
Route::post('/reservations/{roomTypeId}', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/confirmation/{id}', [ReservationController::class, 'confirmation'])->name('reservations.confirmation');
Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
Route::delete('/reservations/{roomTypeId}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
//batalkan reservasi ubah status jadi "Cancelled"
Route::get('/reservation/cancel-by-guest/{id}', [ReservationController::class, 'cancelReservationByGuest'])->name('reservation.cancelByGuest');

//Payment
Route::post('/payment/snap-token', [PaymentController::class, 'getSnapToken']);
Route::post('/payment/success', [PaymentController::class, 'updatePaymentStatus'])->name('payment.success');

//Payment Service
Route::post('/payment-service/snap-token', [PaymentServiceController::class, 'getSnapToken']);
Route::post('/payment-service/success', [PaymentServiceController::class, 'updatePaymentStatus'])->name('service-payment.success');