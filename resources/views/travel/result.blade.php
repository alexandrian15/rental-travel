<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Travel</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen pt-16">
@include('partials.navbar')


    <div class="max-w-5xl mx-auto px-4 mt-6">

        <!-- HEADER ACTION -->
        <div class="flex items-center justify-between mb-6">

            <h1 class="text-xl font-bold text-gray-700">
                Hasil Pencarian Travel
            </h1>

            <!-- BUTTON KEMBALI -->
            <a href="{{ url('/') }}"
               class="inline-flex items-center gap-2 bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-50 transition">
                
                <!-- icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 19l-7-7 7-7" />
                </svg>

                Kembali
            </a>

        </div>

        <!-- RESULT LIST -->
        <div class="space-y-4">

            @forelse($travels as $travel)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition p-5 flex flex-col md:flex-row md:items-center md:justify-between">

                    <!-- INFO -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">
                            {{ $travel->asal }} → {{ $travel->tujuan }}
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            📅 {{ $travel->tanggal }} • ⏰ {{ $travel->jam_berangkat }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            🎫 Sisa kursi: 
                            <span class="font-semibold text-gray-700">
                                {{ $travel->kursi_total - $travel->kursi_terisi }}
                            </span>
                        </p>
                    </div>

                    <!-- PRICE -->
                    <div class="mt-4 md:mt-0 text-right">
                        <p class="text-blue-600 font-bold text-xl">
                            Rp {{ number_format($travel->harga) }}
                        </p>

                        <span class="text-xs text-gray-400">
                            per orang
                        </span>
                    </div>

                </div>
            @empty
                <div class="bg-white p-8 rounded-xl shadow text-center text-gray-500">
                    
                    <p class="text-lg font-semibold">Tidak ada perjalanan ditemukan</p>
                    <p class="text-sm mt-1">Coba ubah tanggal atau tujuan</p>

                </div>
            @endforelse

        </div>

    </div>

</body>
</html>