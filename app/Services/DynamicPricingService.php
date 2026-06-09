<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Holiday;

class DynamicPricingService
{
    public function calculate($car, $tanggalMulai, $tanggalSelesai)
    {
        $hargaPerHari = $car->harga_dasar;

        // Stok tersedia
        $stokTersedia = $car->stok;

        if ($stokTersedia <= 2) {
            $hargaPerHari *= 1.20;
        } elseif ($stokTersedia <= 5) {
            $hargaPerHari *= 1.10;
        }

        $tanggal = Carbon::parse($tanggalMulai);

        // Weekend
        if ($tanggal->isWeekend()) {
            $hargaPerHari *= 1.15;
        }

        // Hari libur nasional
        $isHoliday = Holiday::whereDate(
            'tanggal',
            $tanggal->format('Y-m-d')
        )->exists();

        if ($isHoliday) {
            $hargaPerHari *= 1.25;
        }

        // Demand tinggi
        $bookingAktif = Booking::where('car_id', $car->id)
            ->where('tanggal_mulai', '<=', now())
            ->where('tanggal_selesai', '>=', now())
            ->count();

        if ($bookingAktif >= 5) {
            $hargaPerHari *= 1.30;
        }

        // Lama sewa
        $jumlahHari = Carbon::parse($tanggalMulai)
            ->diffInDays(Carbon::parse($tanggalSelesai)) + 1;

        return round($hargaPerHari * $jumlahHari);
    }
}