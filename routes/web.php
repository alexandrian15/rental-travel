<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\TravelController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rental-mobil', [CarController::class, 'index'])
    ->name('rental.mobil');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])
  ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');});

/*
|--------------------------------------------------------------------------
| Booking
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/booking/{car}', [BookingController::class, 'create'])
        ->name('booking.create');

    Route::post('/booking/{car}', [BookingController::class, 'store'])
        ->name('booking.store');

    Route::post('/booking/hitung/{car}', [BookingController::class, 'cekHarga']);

    Route::get('/car/{car}/availability',
        [BookingController::class, 'availability']);

    Route::get('/car/{car}/unavailable-dates',
        [BookingController::class, 'unavailableDates']);

    Route::get('/booking/{booking}/success',
        [BookingController::class, 'success'])
        ->name('booking.success');

    Route::get('/payment/{booking}',
        [BookingController::class, 'showPayment'])
        ->name('payment.show');

    Route::post('/payment/{booking}/process',
        [BookingController::class, 'processPayment'])
        ->name('payment.process');

    Route::post('/payment/{booking}/confirm',
        [BookingController::class, 'confirmPayment'])
        ->name('payment.confirm');

    Route::get('/booking/{booking}/pdf',
        [BookingController::class, 'downloadPdf'])
        ->name('booking.pdf');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','admin'])->group(function () {

    Route::resource('cars', CarController::class)
        ->except(['index', 'show']);
});

/*
|--------------------------------------------------------------------------
| Google Login
|--------------------------------------------------------------------------
*/

Route::get('/auth/google',
    [GoogleController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback',
    [GoogleController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

Route::get(
    '/tiket-travel',
    [TravelController::class,'index']
)->name('travel.index');

Route::post(
    '/travel/search',
    [TravelController::class,'search']
)->name('travel.search');
Route::get('/travel/search', [TravelController::class, 'index']);