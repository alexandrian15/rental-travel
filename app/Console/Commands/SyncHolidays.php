<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Holiday;

class SyncHolidays extends Command
{
    protected $signature = 'holidays:sync';

    protected $description = 'Sinkronisasi hari libur nasional';

    public function handle()
    {
        $response = Http::timeout(30)
            ->get('https://api-harilibur.vercel.app/api');

        if (!$response->successful()) {
            $this->error('Gagal mengambil data hari libur');
            return;
        }

        $holidays = $response->json();

        foreach ($holidays as $holiday) {

            Holiday::updateOrCreate(
                [
                    'tanggal' => $holiday['holiday_date']
                ],
                [
                    'nama_libur' => $holiday['holiday_name']
                ]
            );
        }

        $this->info('Hari libur berhasil disinkronisasi');
    }
}