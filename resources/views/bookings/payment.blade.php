<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Rental Mobil</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto py-10 px-5">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Pembayaran Rental Mobil
        </h1>

        <p class="text-gray-500 mt-2">
            Selesaikan pembayaran untuk mengkonfirmasi pemesanan kendaraan.
        </p>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        <!-- KIRI -->
        <div class="lg:col-span-2 space-y-6">

            <!-- METODE PEMBAYARAN -->
            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="text-xl font-bold mb-5">
                    Metode Pembayaran
                </h2>

                <div class="space-y-4">

                    <label
                        class="flex items-center justify-between border-2 border-blue-500 bg-blue-50 rounded-xl p-4 cursor-pointer">

                        <div class="flex items-center gap-3">
                            <input type="radio"
                                   checked
                                   name="payment_method">

                            <div>
                                <div class="font-semibold">
                                    Transfer Bank
                                </div>

                                <div class="text-sm text-gray-500">
                                    BCA • Mandiri • BNI • BRI
                                </div>
                            </div>
                        </div>

                        <i class="fa-solid fa-building-columns text-blue-500 text-xl"></i>

                    </label>

                    <label
                        class="flex items-center justify-between border rounded-xl p-4 cursor-pointer">

                        <div class="flex items-center gap-3">
                            <input type="radio"
                                   name="payment_method">

                            <div>
                                <div class="font-semibold">
                                    E-Wallet
                                </div>

                                <div class="text-sm text-gray-500">
                                    OVO • Dana • Gopay
                                </div>
                            </div>
                        </div>

                        <i class="fa-solid fa-wallet text-gray-500 text-xl"></i>

                    </label>

                </div>

            </div>

            <!-- REKENING -->
            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="font-bold text-lg mb-4">
                    Transfer Ke Rekening Berikut
                </h2>

                <div class="bg-gray-50 rounded-xl border p-5">

                    <div class="flex justify-between items-center">

                        <div>
                            <div class="font-bold text-xl">
                                BANK BCA
                            </div>

                            <div class="text-2xl font-mono font-bold text-blue-600">
                                1234567890
                            </div>

                            <div class="text-sm text-gray-500">
                                a.n PT Rental Mobil Indonesia
                            </div>
                        </div>

                        <i class="fa-solid fa-building-columns text-4xl text-blue-500"></i>

                    </div>

                </div>

            </div>

            <!-- BUKTI -->
            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="font-bold text-lg mb-4">
                    Upload Bukti Pembayaran
                </h2>

                <form action="{{ route('payment.confirm',$booking->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <input
                        type="file"
                        name="bukti_transfer"
                        class="w-full border rounded-lg p-3">

                    <button
                        type="submit"
                        class="mt-5 w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold">

                        <i class="fa-solid fa-check mr-2"></i>
                        Saya Sudah Membayar

                    </button>

                </form>

            </div>

        </div>

        <!-- KANAN -->
        <div>

            <div class="bg-white rounded-2xl shadow p-6 sticky top-5">

                <h2 class="text-xl font-bold mb-5">
                    Ringkasan Pesanan
                </h2>

                <div class="space-y-4">

                    <div class="border-b pb-4">

                        <div class="font-bold text-lg">
                            {{ $booking->car->nama_mobil }}
                        </div>

                        <div class="text-sm text-gray-500">
                            {{ $booking->car->plat_nomor }}
                        </div>

                    </div>

                    <div class="flex justify-between">
                        <span>Pemesan</span>
                        <span>{{ $booking->nama_pemesan }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Tanggal Mulai</span>
                        <span>
                            {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span>Tanggal Selesai</span>
                        <span>
                            {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d M Y') }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span>Status</span>

                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm">
                            Pending
                        </span>
                    </div>

                    <hr>

                    <div class="flex justify-between font-bold text-lg">

                        <span>Total Bayar</span>

                        <span class="text-green-600">
                            Rp {{ number_format($booking->total_harga,0,',','.') }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>