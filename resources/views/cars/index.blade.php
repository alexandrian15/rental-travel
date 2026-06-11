<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-slate-100">


@include('partials.navbar')

<!-- HERO -->
<section class="relative h-80 md:h-96 lg:h-[450px] overflow-hidden">

    <img
        src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=2083"
        class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative max-w-7xl mx-auto px-4 md:px-6 lg:px-8 h-full flex items-center">

        <div class="text-white max-w-3xl">

            <h1 class="text-3xl md:text-4xl lg:text-6xl font-black leading-tight">
                RENTAL MOBIL
                ANTAR-KOTA PREMIUM
            </h1>

            <p class="mt-4 md:mt-6 text-lg md:text-xl lg:text-2xl text-slate-200 leading-relaxed">
                Pilihan armada terbaik untuk perjalanan bisnis,
                wisata, keluarga, dan travel antar-kota.
            </p>

        </div>

    </div>
</section>

<!-- CONTENT -->
<section class="max-w-7xl mx-auto py-12 md:py-16 lg:py-20 px-4 md:px-6 lg:px-8">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-6 mb-12 md:mb-16">

        <div>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-800">
                Daftar Armada
            </h2>

            <p class="text-slate-500 mt-2 text-sm md:text-base">
                Pilih kendaraan terbaik untuk perjalanan Anda
            </p>
        </div>

        <div class="w-full md:w-auto">
            <input
                type="text"
                placeholder="Cari mobil..."
                class="border border-slate-300 rounded-2xl px-4 py-3 w-full md:w-[300px] lg:w-[350px] shadow-sm text-sm md:text-base">
        </div>

    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10">

        @forelse($cars as $car)

        <div class="bg-white rounded-[30px] overflow-hidden shadow-xl hover:shadow-2xl transition duration-300 group">

            <!-- GAMBAR -->
            <div class="relative overflow-hidden">

                @if($car->gambar)

                    <img
                        src="{{ asset('storage/' . $car->gambar) }}"
                        class="h-48 sm:h-60 md:h-72 w-full object-cover group-hover:scale-110 transition duration-500">

                @else

                    <img
                        src="https://images.unsplash.com/photo-1502877338535-766e1452684a?q=80&w=2072"
                        class="h-48 sm:h-60 md:h-72 w-full object-cover group-hover:scale-110 transition duration-500">

                @endif

                <div class="absolute top-5 right-5">

                    @if($car->status == 'tersedia')

                        <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                            Tersedia
                        </span>

                    @else

                        <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                            Disewa
                        </span>

                    @endif

                </div>

            </div>

            <!-- CONTENT -->
            <div class="p-4 md:p-7">

                <div class="flex justify-between items-start gap-2">

                    <div>

                        <h3 class="text-xl sm:text-2xl md:text-3xl font-black text-slate-800">
                            {{ $car->nama_mobil }}
                        </h3>

                        <p class="text-slate-500 mt-2 text-xs md:text-sm">
                            {{ $car->plat_nomor }}
                        </p>

                    </div>

                    <div class="bg-slate-100 rounded-2xl px-3 py-1 text-xs font-bold text-slate-700 whitespace-nowrap">
                        Premium
                    </div>

                </div>

                <!-- FITUR -->
                <div class="mt-4 md:mt-6 grid grid-cols-3 gap-2 md:gap-3 text-center">

                    <div class="bg-slate-100 rounded-2xl p-2 md:p-3">
                        <p class="font-bold text-slate-700 text-xs md:text-sm">AC</p>
                    </div>

                    <div class="bg-slate-100 rounded-2xl p-2 md:p-3">
                        <p class="font-bold text-slate-700 text-xs md:text-sm">GPS</p>
                    </div>

                    <div class="bg-slate-100 rounded-2xl p-2 md:p-3">
                        <p class="font-bold text-slate-700 text-xs md:text-sm">Audio</p>
                    </div>

                </div>

                <!-- HARGA -->
                <div class="mt-6 md:mt-8">

                    <p class="text-slate-500 text-xs md:text-sm">
                        Harga Mulai
                    </p>

                    <h4 class="text-2xl md:text-4xl font-black text-red-600">
                        Rp {{ number_format($car->harga_dasar,0,',','.') }}
                    </h4>

                    <p class="text-slate-500 text-xs md:text-sm">
                        / hari
                    </p>

                </div>

               <!-- BUTTON -->
<div class="mt-6 md:mt-8">

    @auth

        @if(auth()->user()->role == 'admin')

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 md:gap-3">

                <!-- PESAN -->
                <a href="{{ route('booking.create', $car->id) }}"
                   class="bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl text-center font-bold text-sm md:text-base">
                    Pesan
                </a>

                <!-- EDIT -->
                <a href="{{ route('cars.edit', $car->id) }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-2xl text-center font-bold text-sm md:text-base">
                    Edit
                </a>

                <!-- DELETE -->
                <form action="{{ route('cars.destroy', $car->id) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            onclick="return confirm('Hapus mobil ini?')"
                            class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-2xl font-bold text-sm md:text-base">

                        Hapus

                    </button>

                </form>

            </div>

        @else

            <!-- CUSTOMER -->
            <a href="{{ route('booking.create', $car->id) }}"
               class="block bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl text-center font-bold text-sm md:text-base">

                Pesan Sekarang

            </a>

        @endif

    @endauth

    @guest

        <a href="{{ route('google.login', $car->id) }}"
           class="block bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl text-center font-bold text-sm md:text-base">

            Login Google & Pesan

        </a>

    @endguest

                </div>

            </div>

        </div>

        @empty

        <div class="col-span-3">

            <div class="bg-white rounded-[30px] p-20 text-center shadow-xl">

                <h2 class="text-4xl font-black text-slate-700">
                    Belum Ada Armada
                </h2>

                <p class="text-slate-500 mt-4 text-xl">
                    Tambahkan mobil pertama untuk memulai sistem rental.
                </p>

                @auth
                    @if(auth()->user()->role == 'admin')

                        <a href="{{ route('cars.create') }}"
                           class="inline-block mt-8 bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-2xl font-bold shadow-xl">

                            Tambah Mobil

                        </a>

                    @endif
                @endauth

            </div>

        </div>

        @endforelse

    </div>

</section>

</body>
</html>