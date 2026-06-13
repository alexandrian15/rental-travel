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

    <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=2083"
         class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative max-w-7xl mx-auto px-4 md:px-6 lg:px-8 h-full flex items-center">

        <div class="text-white max-w-3xl">

            <h1 class="text-3xl md:text-4xl lg:text-6xl font-black leading-tight">
                RENTAL MOBIL ANTAR-KOTA PREMIUM
            </h1>

            <p class="mt-4 md:mt-6 text-lg md:text-xl lg:text-2xl text-slate-200">
                Pilihan armada terbaik untuk perjalanan bisnis, wisata, keluarga, dan travel.
            </p>

        </div>

    </div>
</section>

<!-- CONTENT -->
<section class="max-w-7xl mx-auto py-12 px-4 md:px-6 lg:px-8">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row justify-between gap-4 mb-12">

        <div>
            <h2 class="text-3xl md:text-4xl font-black text-slate-800">
                Daftar Armada
            </h2>
            <p class="text-slate-500 mt-2">
                Pilih kendaraan terbaik untuk perjalanan Anda
            </p>
        </div>

        <div class="flex gap-3 w-full md:w-auto">

            <form method="GET" action="{{ route('rental.mobil') }}">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari mobil..."
                       class="border border-slate-300 rounded-2xl px-4 py-3 w-full md:w-[300px]">
            </form>

            @auth
                @if(auth()->user()->role == 'admin')
                    <a href="{{ route('cars.create') }}"
                       class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-2xl font-bold">
                        + Tambah Armada
                    </a>
                @endif
            @endauth

        </div>
    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($cars as $car)

        <div id="car-{{ $car->id }}"
             class="bg-white rounded-[30px] overflow-hidden shadow-xl group">

            <!-- IMAGE -->
            <div class="relative">

                <img src="{{ $car->gambar ? asset('storage/'.$car->gambar) : 'https://images.unsplash.com/photo-1502877338535-766e1452684a' }}"
                     class="h-60 w-full object-cover group-hover:scale-110 transition">

                <div class="absolute top-4 right-4">

                    <span class="{{ $car->status == 'tersedia' ? 'bg-green-500' : 'bg-red-500' }} text-white px-4 py-2 rounded-full text-sm font-bold">
                        {{ ucfirst($car->status) }}
                    </span>

                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-6">

                <h3 class="text-2xl font-black text-slate-800">
                    {{ $car->nama_mobil }}
                </h3>

                <p class="text-slate-500 text-sm">
                    {{ $car->plat_nomor }}
                </p>

                <div class="mt-4">
                    <p class="text-slate-500 text-sm">Harga Mulai</p>
                    <h4 class="text-3xl font-black text-red-600">
                        Rp {{ number_format($car->harga_dasar,0,',','.') }}
                    </h4>
                </div>

                <!-- BUTTON -->
                <div class="mt-6">

                

                    @auth
                        @if(auth()->user()->role == 'admin')

                        <div class="grid grid-cols-2 gap-2">

                            <a href="{{ route('cars.edit', $car->id) }}"
                               class="bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-2xl text-center font-bold">
                                Edit
                            </a>

                            <button type="button"
                                    onclick="deleteCar({{ $car->id }})"
                                    class="bg-red-600 hover:bg-red-700 text-white py-3 rounded-2xl font-bold">
                                Hapus
                            </button>

                        </div>

                        @else
                            <a href="{{ route('booking.create', $car->id) }}"
                               class="block bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl text-center font-bold">
                                Pesan Sekarang
                            </a>
                        @endif
                    @endauth

                    @guest
                        <a href="/auth/google"
                           class="block bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl text-center font-bold">
                            Login untuk Memesan
                        </a>
                        
                    @endguest

                </div>

            </div>
        </div>

        @empty
        <div class="col-span-3 text-center py-20">
            <h2 class="text-3xl font-black">Belum Ada Armada</h2>
        </div>
        @endforelse

    </div>

</section>

<!-- DELETE AJAX (FIXED) -->
<script>
function deleteCar(id) {
    if (!confirm('Yakin ingin menghapus mobil ini?')) return;

    fetch(`/cars/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            _method: 'DELETE'
        })
    })
    .then(res => {
        if (!res.ok) throw new Error('Delete gagal');

        // hapus card dari UI
        document.getElementById('car-' + id)?.remove();

        alert('Mobil berhasil dihapus');
    })
    .catch(err => {
        console.log(err);
        alert('Gagal menghapus mobil');
    });
}
</script>

</body>
</html>