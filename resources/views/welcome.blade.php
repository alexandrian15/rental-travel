<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clift & Travelindo</title>

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body class="bg-slate-100 overflow-x-hidden">

@include('partials.navbar')

<!-- HERO SECTION -->
<section class="relative w-full min-h-screen bg-black overflow-hidden flex items-center">

    <!-- BACKGROUND -->
    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070"
         class="absolute inset-0 w-full h-full object-cover opacity-40">

    <div class="absolute inset-0 bg-black/60"></div>

    <!-- CONTENT -->
    <div class="relative w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid md:grid-cols-2 gap-10 items-center">

            <!-- LEFT CONTENT -->
            <div class="text-white">

                <h1 class="text-4xl md:text-6xl font-black leading-tight">
                    PESAN RENTAL & TRAVEL<br>
                    DENGAN MUDAH
                </h1>

                <p class="mt-6 text-lg md:text-2xl text-slate-200 leading-relaxed">
                    Sistem informasi e-commerce rental mobil dan tiket travel antar-kota dengan metode dynamic pricing modern.
                </p>

                <div class="mt-8 space-y-2 text-base md:text-lg font-semibold text-slate-100">
                    <p>• Surabaya → Jakarta</p>
                    <p>• Malang → Bandung</p>
                    <p>• Surabaya → Denpasar</p>
                    <p>• Malang → Yogyakarta</p>
                    <p>• Kediri → Jakarta</p>
                </div>

            </div>

            <!-- RIGHT BOOKING CARD -->
            <div class="w-full max-w-md mx-auto md:mx-0 md:ml-auto">

                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

                    <!-- HEADER TAB -->
                    <div class="bg-red-600 text-white text-center py-4 font-bold">
                        Tiket Travel
                    </div>

                    <!-- FORM -->
                    <div class="p-6 md:p-8">

                        <form method="POST" action="{{ route('travel.search') }}" class="space-y-5">
                            @csrf

                            <!-- ASAL -->
                            <div>
                                <label class="text-sm font-semibold text-slate-600">Kota Asal</label>
                                <input type="text"
                                       name="asal"
                                       placeholder="Contoh: Surabaya"
                                       class="w-full mt-2 px-4 py-3 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none"
                                       required>
                            </div>

                            <!-- TUJUAN -->
                            <div>
                                <label class="text-sm font-semibold text-slate-600">Kota Tujuan</label>
                                <input type="text"
                                       name="tujuan"
                                       placeholder="Contoh: Jakarta"
                                       class="w-full mt-2 px-4 py-3 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none"
                                       required>
                            </div>

                            <!-- TANGGAL -->
                            <div>
                                <label class="text-sm font-semibold text-slate-600">Tanggal Keberangkatan</label>
                                <input type="date"
                                       name="tanggal"
                                       class="w-full mt-2 px-4 py-3 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none"
                                       required>
                            </div>

                            <!-- BUTTON -->
                            <button type="submit"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl transition">
                                Cari Tiket
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- SCRIPT DATE PICKER -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("input[type=date]", {
        dateFormat: "Y-m-d",
        minDate: "today"
    });
</script>

</body>
</html>