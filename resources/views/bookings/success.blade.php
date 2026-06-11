<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Berhasil</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-slate-100 to-slate-200">

@include('partials.navbar')

<div class="min-h-screen flex items-center justify-center p-4 md:p-6">

    <div class="max-w-2xl w-full bg-white rounded-2xl md:rounded-3xl shadow-2xl overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 via-emerald-500 to-green-500 text-white p-6 md:p-8 text-center">

            <div class="w-24 h-24 mx-auto bg-white/20 rounded-full flex items-center justify-center mb-5">
                <i class="fa-solid fa-circle-check text-6xl"></i>
            </div>

            <h1 class="text-2xl md:text-3xl font-bold">
                Pembayaran Berhasil
            </h1>

            <p class="mt-2 text-green-100">
                Terima kasih, booking Anda telah berhasil dikonfirmasi.
            </p>

        </div>

        <!-- Content -->
        <div class="p-6 md:p-8">

            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6">

                <div class="flex justify-between py-4 border-b">
                    <span class="text-gray-500">No Booking</span>
                    <span class="font-bold text-gray-800">
                        BK-{{ str_pad($booking->id,6,'0',STR_PAD_LEFT) }}
                    </span>
                </div>

                <div class="flex justify-between py-4 border-b">
                    <span class="text-gray-500">Nama Pemesan</span>
                    <span class="font-semibold">
                        {{ $booking->nama_pemesan }}
                    </span>
                </div>

                <div class="flex justify-between py-4 border-b">
                    <span class="text-gray-500">Mobil</span>
                    <span class="font-semibold">
                        {{ $booking->car?->nama_mobil ?? '-' }}
                    </span>
                </div>

                <div class="flex justify-between py-4 border-b">
                    <span class="text-gray-500">Tanggal Sewa</span>
                    <span class="font-semibold">
                        {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') }}
                        -
                        {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d M Y') }}
                    </span>
                </div>

                <div class="flex justify-between py-4">
                    <span class="text-gray-500">Total Bayar</span>
                    <span class="text-2xl font-bold text-green-600">
                        Rp {{ number_format($booking->total_harga,0,',','.') }}
                    </span>
                </div>

            </div>

            <!-- Status -->
            <div class="mt-6 text-center">
                <span class="bg-green-100 text-green-700 px-6 py-2 rounded-full font-semibold">
                    ✓ LUNAS
                </span>
            </div>

            <!-- Info -->
            <div class="mt-6 bg-blue-50 border border-blue-100 rounded-xl p-4">
                <p class="text-sm text-blue-700 text-center">
                    Simpan bukti pembayaran dan invoice PDF sebagai referensi perjalanan Anda.
                </p>
            </div>

            <!-- Action Button -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">

                <a href="{{ url('/') }}"
                   class="text-center bg-slate-200 hover:bg-slate-300 transition py-3 rounded-xl font-semibold">
                    <i class="fa-solid fa-house mr-2"></i>
                    Beranda
                </a>

                <a href="{{ route('booking.pdf',$booking->id) }}"
                   class="text-center bg-green-600 hover:bg-green-700 transition text-white py-3 rounded-xl font-semibold">
                    <i class="fa-solid fa-file-pdf mr-2"></i>
                    Download PDF
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>