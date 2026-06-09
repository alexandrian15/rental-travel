```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-slate-100">

<!-- NAVBAR -->
<nav class="bg-gradient-to-r from-slate-900 via-red-900 to-red-700 text-white shadow-2xl">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center py-5">

            <div>

                <h1 class="text-4xl font-black">
                    RENTAL<span class="text-red-500">TRAVEL</span>
                </h1>

                <p class="text-sm text-slate-300">
                    Rental Mobil Premium
                </p>

            </div>

            <div class="flex gap-5 items-center">

                <a href="{{ url('/') }}"
                   class="hover:text-red-400 transition font-semibold">

                    Beranda
                </a>

                <a href="{{ route('cars.create') }}"
                   class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-2xl font-bold shadow-xl transition">

                    + Tambah Mobil
                </a>

            </div>

        </div>

    </div>

</nav>

<!-- HERO -->
<section class="relative h-[450px] overflow-hidden">

    <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=2083"
         class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative max-w-7xl mx-auto px-6 h-full flex items-center">

        <div class="text-white max-w-3xl">

            <h1 class="text-6xl font-black leading-tight">

                RENTAL MOBIL
                ANTAR-KOTA PREMIUM

            </h1>

            <p class="mt-6 text-2xl text-slate-200 leading-relaxed">

                Pilihan armada terbaik untuk perjalanan
                bisnis, wisata, keluarga, dan travel antar-kota.

            </p>

        </div>

    </div>

</section>

<!-- CONTENT -->
<section class="max-w-7xl mx-auto py-16 px-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">

        <div>

            <h2 class="text-4xl font-black text-slate-800">
                Daftar Armada
            </h2>

            <p class="text-slate-500 mt-2">
                Pilih kendaraan terbaik untuk perjalanan Anda
            </p>

        </div>

        <!-- SEARCH -->
        <div>

            <input type="text"
                   placeholder="Cari mobil..."
                   class="border border-slate-300 rounded-2xl px-5 py-4 w-[300px] shadow-sm">

        </div>

    </div>

    <!-- GRID -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">

        @forelse($cars as $car)

        <!-- CARD -->
        <div class="bg-white rounded-[30px] overflow-hidden shadow-xl hover:shadow-2xl transition duration-300 group">

            <!-- IMAGE -->
            <div class="relative overflow-hidden">

                @if($car->gambar)

                <img src="{{ asset('storage/' . $car->gambar) }}"
                     class="h-72 w-full object-cover group-hover:scale-110 transition duration-500">

                @else

                <img src="https://images.unsplash.com/photo-1502877338535-766e1452684a?q=80&w=2072"
                     class="h-72 w-full object-cover group-hover:scale-110 transition duration-500">

                @endif

                <!-- STATUS -->
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
            <div class="p-7">

                <div class="flex justify-between items-start">

                    <div>

                        <h3 class="text-3xl font-black text-slate-800">

                            {{ $car->nama_mobil }}

                        </h3>

                        <p class="text-slate-500 mt-2">
                            {{ $car->plat_nomor }}
                        </p>

                    </div>

                    <div class="bg-slate-100 rounded-2xl px-4 py-2 text-sm font-bold text-slate-700">

                        Premium

                    </div>

                </div>

                <!-- FEATURE -->
                <div class="mt-6 grid grid-cols-3 gap-3 text-center">

                    <div class="bg-slate-100 rounded-2xl p-3">

                        <p class="font-bold text-slate-700">
                            AC
                        </p>

                    </div>

                    <div class="bg-slate-100 rounded-2xl p-3">

                        <p class="font-bold text-slate-700">
                            GPS
                        </p>

                    </div>

                    <div class="bg-slate-100 rounded-2xl p-3">

                        <p class="font-bold text-slate-700">
                            Audio
                        </p>

                    </div>

                </div>

                <!-- PRICE -->
                <div class="mt-8 flex justify-between items-center">

                    <div>

                        <p class="text-slate-500">
                            Harga Mulai
                        </p>

                        <h4 class="text-4xl font-black text-red-600">

                            Rp {{ number_format($car->harga_dasar) }}

                        </h4>

                        <p class="text-slate-500 text-sm">
                            / hari
                        </p>

                    </div>

                </div>


<!-- BUTTON -->
<div class="mt-8 grid grid-cols-3 gap-3">

    <!-- PESAN -->
    <a href="{{ route('bookings.create', $car->id) }}"
       class="bg-green-600 hover:bg-green-700 text-white py-4 rounded-2xl text-center font-bold shadow-lg transition">

        Pesan
    </a>

    <!-- EDIT -->
    <a href="{{ route('cars.edit', $car->id) }}"
       class="bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-2xl text-center font-bold shadow-lg transition">

        Edit
    </a>

    <!-- DELETE -->
    <form action="{{ route('cars.destroy', $car->id) }}"
          method="POST">

        @csrf
        @method('DELETE')

        <div class="card mt-3">
    <div class="card-body">
        <h4 id="totalHarga">
            Rp 0
        </h4>
    </div>
</div>

        <button type="submit"
                onclick="return confirm('Hapus mobil ini?')"
                class="w-full bg-red-600 hover:bg-red-700 text-white py-4 rounded-2xl font-bold shadow-lg transition">

            Hapus
        </button>

    </form>

</div>
```


            </div>

        </div>

        @empty

        <!-- EMPTY -->
        <div class="col-span-3">

            <div class="bg-white rounded-[30px] p-20 text-center shadow-xl">

                <h2 class="text-4xl font-black text-slate-700">

                    Belum Ada Armada

                </h2>

                <p class="text-slate-500 mt-4 text-xl">

                    Tambahkan mobil pertama untuk memulai sistem rental.

                </p>

                <a href="{{ route('cars.create') }}"
                   class="inline-block mt-8 bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-2xl font-bold shadow-xl transition">

                    Tambah Mobil
                </a>

            </div>

        </div>

        @endforelse

    </div>

</section>

<script>
function hitungHarga() {

    let mulai =
        document.getElementById('tanggal_mulai').value;

    let selesai =
        document.getElementById('tanggal_selesai').value;

    if(!mulai || !selesai) return;

    fetch('/booking/hitung/{{ $car->id }}', {

        method:'POST',

        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':
                '{{ csrf_token() }}'
        },

        body: JSON.stringify({
            tanggal_mulai: mulai,
            tanggal_selesai: selesai
        })

    })
    .then(res => res.json())
    .then(data => {

        document.getElementById('totalHarga')
            .innerHTML =
            'Rp ' +
            Number(data.harga)
            .toLocaleString('id-ID');

    });
}

document.getElementById('tanggal_mulai')
    .addEventListener('change', hitungHarga);

document.getElementById('tanggal_selesai')
    .addEventListener('change', hitungHarga);
</script>

</body>
</html>
```
