<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total booking
        $totalBooking = Booking::count();

        // Total pendapatan
        $totalPendapatan = Booking::sum('total_harga');

        // Total mobil
        $totalMobil = Car::count();

        // Mobil tersedia
        $mobilTersedia = Car::where('status', 'tersedia')->count();

        // Mobil dibooking
        $mobilDibooking = Car::where('status', 'dibooking')->count();

        // Booking bulan ini
        $bookingBulanIni = Booking::whereMonth(
            'created_at',
            now()->month
        )->count();

        // Pendapatan bulan ini
        $pendapatanBulanIni = Booking::whereMonth(
            'created_at',
            now()->month
        )->sum('total_harga');

        // Mobil terlaris
        $mobilTerlaris = Booking::selectRaw(
                'car_id, COUNT(*) as total_booking'
            )
            ->with('car')
            ->groupBy('car_id')
            ->orderByDesc('total_booking')
            ->first();

        // 5 booking terbaru
        $bookingTerbaru = Booking::with('car')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBooking',
            'totalPendapatan',
            'totalMobil',
            'mobilTersedia',
            'mobilDibooking',
            'bookingBulanIni',
            'pendapatanBulanIni',
            'mobilTerlaris',
            'bookingTerbaru'
        ));
    }
}