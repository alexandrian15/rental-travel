<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mobil</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-slate-100 min-h-screen">

@include('partials.navbar')

<div class="max-w-5xl mx-auto py-12 md:py-16 px-4 md:px-6 lg:px-8">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">

        <div>

            <h1 class="text-3xl md:text-5xl font-black text-slate-800">
                Edit Armada
            </h1>

            <p class="text-slate-500 mt-2 text-sm md:text-base">
                Update data kendaraan rental
            </p>

        </div>

        <a href="{{ route('cars.index') }}"
           class="bg-slate-800 hover:bg-slate-900 text-white px-6 py-4 rounded-2xl font-bold shadow-xl transition">

            ← Kembali
        </a>

    </div>

    <!-- CARD -->
    <div class="bg-white rounded-[30px] shadow-2xl overflow-hidden">

        <div class="grid md:grid-cols-2">

            <!-- IMAGE -->
            <div class="bg-slate-200 p-4 md:p-6 lg:p-8 flex items-center justify-center">

                @if($car->gambar)

                <img src="{{ asset('storage/' . $car->gambar) }}"
                     class="rounded-3xl shadow-2xl h-64 md:h-[450px] w-full object-cover">

                @else

                <div class="w-full h-[450px] bg-slate-300 rounded-3xl flex items-center justify-center">

                    <span class="text-slate-500 text-xl">
                        No Image
                    </span>

                </div>

                @endif

            </div>

            <!-- FORM -->
            <div class="p-6 md:p-10">

                <form action="{{ route('cars.update', $car->id) }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-6">

                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div>

                        <label class="block font-bold text-slate-700 mb-2">
                            Nama Mobil
                        </label>

                        <input type="text"
                               name="nama_mobil"
                               value="{{ $car->nama_mobil }}"
                               class="w-full border border-slate-300 rounded-2xl px-5 py-4">

                    </div>

                    <!-- Plat -->
                    <div>

                        <label class="block font-bold text-slate-700 mb-2">
                            Plat Nomor
                        </label>

                        <input type="text"
                               name="plat_nomor"
                               value="{{ $car->plat_nomor }}"
                               class="w-full border border-slate-300 rounded-2xl px-5 py-4">

                    </div>

                    <!-- Harga -->
                    <div>

                        <label class="block font-bold text-slate-700 mb-2">
                            Harga Dasar
                        </label>

                        <input type="number"
                               name="harga_dasar"
                               value="{{ $car->harga_dasar }}"
                               class="w-full border border-slate-300 rounded-2xl px-5 py-4">

                    </div>

                    <!-- Upload -->
                    <div>

                        <label class="block font-bold text-slate-700 mb-2">
                            Ganti Gambar
                        </label>

                        <input type="file"
                               name="gambar"
                               class="w-full border border-slate-300 rounded-2xl px-5 py-4">

                    </div>

                    <!-- Status -->
                    <div>

                        <label class="block font-bold text-slate-700 mb-2">
                            Status
                        </label>

                        <select name="status"
                                class="w-full border border-slate-300 rounded-2xl px-5 py-4">

                            <option value="tersedia"
                                {{ $car->status == 'tersedia' ? 'selected' : '' }}>

                                Tersedia

                            </option>

                            <option value="disewa"
                                {{ $car->status == 'disewa' ? 'selected' : '' }}>

                                Disewa

                            </option>

                        </select>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                            class="w-full bg-indigo-700 hover:bg-indigo-800 text-white py-5 rounded-2xl font-black text-lg shadow-xl transition">

                        Update Data Mobil
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>