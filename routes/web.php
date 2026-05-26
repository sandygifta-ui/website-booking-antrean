<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->email == 'admin@resto.com') {
            return redirect('/admin/reservations');
        }
        return redirect('/booking');
    }
    return redirect('/login');
});

// Autentikasi Publik
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// Area Tamu
Route::middleware('auth')->group(function () {
    Route::get('/booking', [ReservationController::class, 'index']);
    Route::post('/booking', [ReservationController::class, 'store']);
});

// Area Admin
Route::middleware('auth')->group(function () {
    Route::get('/admin/reservations', function () {
        if (Auth::user()->email !== 'admin@resto.com') {
            return redirect('/booking');
        }
        $reservations = \App\Models\Reservation::with('table')->get();
        return view('admin_reservations', compact('reservations'));
    });

    // --- TOMBOL CENTANG / DELETE BARU ---
    Route::delete('/admin/reservations/{id}', function ($id) {
        $reservation = \App\Models\Reservation::findOrFail($id);
        $reservation->delete();

        return back()->with('success', 'Pelanggan berhasil check-in dan daftar diperbarui! ✨');
    });
});