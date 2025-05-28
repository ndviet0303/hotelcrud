<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Receptionist\DashboardController;
use App\Http\Controllers\Receptionist\CheckinController;
use App\Http\Controllers\Receptionist\RoomController as ReceptionistRoomController;
use App\Http\Controllers\Receptionist\InvoiceController;
use App\Http\Controllers\AuthController;

// Trang chủ
Route::get('/', function () {
    return view('home');
})->name('home');

// Auth routes (custom)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Khách hàng
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/bookings/confirm/{room}', [BookingController::class, 'confirm'])->name('bookings.confirm');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/my', [BookingController::class, 'myBookings'])->name('bookings.my');

// Lễ tân (middleware role:receptionist)
Route::prefix('receptionist')->middleware(['auth', RoleMiddleware::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('receptionist.dashboard');
    Route::get('/checkin', [CheckinController::class, 'index'])->name('receptionist.checkin');
    Route::get('/checkin/confirm', [CheckinController::class, 'confirm'])->name('receptionist.checkin.confirm');
    Route::post('/checkin/process/{booking}', [CheckinController::class, 'process'])->name('receptionist.checkin.process');
    Route::get('/rooms', [ReceptionistRoomController::class, 'index'])->name('receptionist.rooms.index');
    Route::get('/rooms/{room}', [ReceptionistRoomController::class, 'show'])->name('receptionist.rooms.show');
    Route::post('/rooms/{room}/services', [ReceptionistRoomController::class, 'storeService'])->name('receptionist.services.store');
    Route::get('/rooms/{room}/checkout', [ReceptionistRoomController::class, 'checkout'])->name('receptionist.checkout');
    Route::get('/invoice/{booking}', [InvoiceController::class, 'show'])->name('receptionist.invoice');
    Route::post('/checkout/process/{booking}', [InvoiceController::class, 'process'])->name('receptionist.checkout.process');
});
