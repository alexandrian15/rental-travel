<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mobil</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 min-h-screen">

@include('partials.navbar')

<div class="max-w-5xl mx-auto py-12 md:py-16 px-4 md:px-6 lg:px-8">

    <!-- HEADER -->
    <div class="mb-10 md:mb-16">

        <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-white">
            Tambah Armada Rental
        </h1>

        <p class="text-slate-300 mt-3 text-sm md:text-lg">
            Tambahkan mobil baru ke sistem rental & travel
        </p>

    </div>

    <!-- ERROR VALIDATION -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- CARD -->
    <div class="bg-white rounded-[30px] shadow-2xl overflow-hidden">

        <div class="grid md:grid-cols-2">

            <!-- LEFT -->
            <div class="bg-gradient-to-br from-indigo-700 to-slate-900 p-6 md:p-8 lg:p-10 text-white flex flex-col justify-center">

                <h2 class="text-2xl md:text-4xl font-black leading-tight">
                    Sistem Informasi Rental Mobil & Travel
                </h2>

                <p class="mt-6 text-slate-200 leading-relaxed">
                    Kelola armada kendaraan secara modern,
                    profesional, dan terintegrasi dengan
                    sistem dynamic pricing.
                </p>

                <div class="mt-10 space-y-4">

                    <div class="bg-white/10 rounded-2xl p-4">
                        🚗 Rental Mobil Premium
                    </div>

                    <div class="bg-white/10 rounded-2xl p-4">
                        🎫 Tiket Travel Antar-Kota
                    </div>

                    <div class="bg-white/10 rounded-2xl p-4">
                        📈 Dynamic Pricing
                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="p-6 md:p-10">

                <form action="{{ route('cars.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-6">

                    @csrf

                    <!-- Nama Mobil -->
                    <div>
                        <label class="block text-slate-700 font-bold mb-2">
                            Nama Mobil
                        </label>

                        <input type="text"
                               name="nama_mobil"
                               value="{{ old('nama_mobil') }}"
                               placeholder="Contoh: Toyota Alphard"
                               class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-indigo-300 outline-none">
                    </div>

                    <!-- Plat -->
                    <div>
                        <label class="block text-slate-700 font-bold mb-2">
                            Plat Nomor
                        </label>

                        <input type="text"
                               name="plat_nomor"
                               value="{{ old('plat_nomor') }}"
                               placeholder="N 1234 AB"
                               class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-indigo-300 outline-none">
                    </div>

                    <!-- Harga -->
                    <div>
                        <label class="block text-slate-700 font-bold mb-2">
                            Harga Dasar
                        </label>

                        <input type="number"
                               name="harga_dasar"
                               value="{{ old('harga_dasar') }}"
                               placeholder="500000"
                               class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-indigo-300 outline-none">
                    </div>

                    <!-- Gambar -->
                    <div>
                        <label class="block text-slate-700 font-bold mb-2">
                            Upload Gambar
                        </label>

                        <input type="file"
                               name="gambar"
                               class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-indigo-300 outline-none">
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-slate-700 font-bold mb-2">
                            Status
                        </label>

                        <select name="status"
                                class="w-full border border-slate-300 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-indigo-300 outline-none">

                            <option value="tersedia"
                                {{ old('status') == 'tersedia' ? 'selected' : '' }}>
                                Tersedia
                            </option>

                            <option value="disewa"
                                {{ old('status') == 'disewa' ? 'selected' : '' }}>
                                Disewa
                            </option>

                        </select>
                    </div>

                    <!-- BUTTON -->
                    <div class="flex gap-4 pt-4">

                        <a href="{{ route('rental.mobil') }}"
                           class="flex-1 text-center bg-slate-300 hover:bg-slate-400 text-slate-700 py-4 rounded-2xl font-bold transition">

                            Kembali
                        </a>

                        <button type="submit"
                                class="flex-1 bg-indigo-700 hover:bg-indigo-800 text-white py-4 rounded-2xl font-bold shadow-xl transition">

                            Simpan Mobil
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>