<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/rental-mobil', [CarController::class, 'index']) ->name('rental.mobil');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/booking/{car}', [
    BookingController::class,
    'create'
])->name('bookings.create');

Route::post('/booking/{car}', [
    BookingController::class,
    'store'
])->name('bookings.store');

require __DIR__.'/auth.php';

Route::resource('cars', CarController::class);

Route::post('/cek-harga', [BookingController::class, 'cekHarga']);

Route::get('/car/{car}/availability',
    [BookingController::class, 'availability']
);

Route::post(
    '/booking/hitung/{car}',
    [BookingController::class, 'cekHarga']
);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

Route::get(
    '/car/{car}/unavailable-dates',
    [BookingController::class, 'unavailableDates']
);

Route::get(
    '/booking/{booking}/success',
    [BookingController::class, 'success']
)->name('booking.success');

Route::get(
    '/payment/{booking}',
    [BookingController::class, 'showPayment']
)->name('payment.show');

Route::post(
    '/payment/{booking}/process',
    [BookingController::class,'processPayment']
)->name('payment.process');

Route::get(
    '/payment/{booking}',
    [BookingController::class, 'showPayment']
)->name('payment.show');

Route::post(
    '/payment/{booking}/confirm',
    [BookingController::class, 'confirmPayment']
)->name('payment.confirm');

Route::get(
    '/booking/{booking}/pdf',
    [BookingController::class,'downloadPdf']
)->name('booking.pdf');

Route::middleware(['auth','admin'])->group(function () {

    Route::get('/cars/create', [CarController::class,'create'])
        ->name('cars.create');

    Route::post('/cars', [CarController::class,'store'])
        ->name('cars.store');

    Route::delete('/cars/{car}', [CarController::class,'destroy'])
        ->name('cars.destroy');

});

Route::middleware('auth')->group(function () {

    Route::get('/booking/{car}', [BookingController::class,'create'])
        ->name('booking.create');

    Route::post('/booking', [BookingController::class,'store'])
        ->name('booking.store');

});

Route::middleware(['auth','admin'])->group(function () {

    Route::get('/cars/create',
        [CarController::class,'create'])
        ->name('cars.create');

    Route::post('/cars',
        [CarController::class,'store'])
        ->name('cars.store');

    Route::get('/cars/{car}/edit',
        [CarController::class,'edit'])
        ->name('cars.edit');

    Route::put('/cars/{car}',
        [CarController::class,'update'])
        ->name('cars.update');

    Route::delete('/cars/{car}',
        [CarController::class,'destroy'])
        ->name('cars.destroy');

});

Route::middleware(['auth','admin'])->group(function () {

    Route::resource('cars', CarController::class)
        ->except(['index','show']);

});




Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback']);