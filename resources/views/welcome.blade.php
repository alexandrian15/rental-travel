<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clift & Travelindo</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-slate-100 overflow-x-hidden">

@include('partials.navbar')

<!-- HERO -->
<section class="relative w-full min-h-screen bg-black overflow-hidden">

    <!-- BACKGROUND IMAGE -->
    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070"
         class="absolute inset-0 w-full h-full object-cover opacity-40">

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- CONTENT -->
    <div class="relative max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 lg:py-20">

        <div class="grid md:grid-cols-2 gap-8 md:gap-12 lg:gap-16 items-center">

            <!-- LEFT -->
            <div class="text-white">


                <h1 class="text-4xl md:text-6xl font-black leading-tight">

                    PESAN RENTAL & TRAVEL
                    DENGAN MUDAH

                </h1>

                <p class="mt-8 text-2xl text-slate-200 leading-relaxed">

                    Sistem informasi e-commerce rental mobil
                    dan tiket travel antar-kota dengan
                    metode dynamic pricing modern.

                </p>

                <!-- ROUTE -->
                <div class="mt-10 space-y-3 text-2xl font-bold">

                    <p>- Surabaya → Jakarta</p>
                    <p>- Malang → Bandung</p>
                    <p>- Surabaya → Denpasar</p>
                    <p>- Malang → Yogyakarta</p>
                    <p>- Kediri → Jakarta</p>

                </div>

            </div>

            <!-- BOOKING CARD -->
            <div>

                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

                    <!-- TAB -->
                    <div class="flex">

                        <button class="flex-1 py-5 bg-red-600 text-white font-bold">
                            Tiket Travel
                        </button>


                    </div>

                    <!-- FORM -->
                    <div class="p-8 space-y-6">

                        <!-- DARI -->
                        <div>

                            <label class="block mb-2 font-bold text-slate-700">
                                Dari
                            </label>

                            <input type="text"
                                   placeholder="Masukkan Kota Asal"
                                   class="w-full border border-slate-300 rounded-2xl px-5 py-4">

                        </div>

                        <!-- TUJUAN -->
                        <div>

                            <label class="block mb-2 font-bold text-slate-700">
                                Tujuan
                            </label>

                            <input type="text"
                                   placeholder="Masukkan Kota Tujuan"
                                   class="w-full border border-slate-300 rounded-2xl px-5 py-4">

                        </div>

                        <!-- TANGGAL -->
                        <div>

                            <label class="block mb-2 font-bold text-slate-700">
                                Tanggal Berangkat
                            </label>

                            <input type="date"
                                   class="w-full border border-slate-300 rounded-2xl px-5 py-4">

                        </div>

                        <!-- PENUMPANG -->
                        <div>

                            <label class="block mb-2 font-bold text-slate-700">
                                Penumpang
                            </label>

                            <select class="w-full border border-slate-300 rounded-2xl px-5 py-4">

                                <option>1 Penumpang</option>
                                <option>2 Penumpang</option>
                                <option>3 Penumpang</option>
                                <option>4 Penumpang</option>

                            </select>

                        </div>

                        <!-- KELAS -->
                        <div>

                            <label class="block mb-2 font-bold text-slate-700">
                                Kelas
                            </label>

                            <select class="w-full border border-slate-300 rounded-2xl px-5 py-4">

                                <option>Executive</option>
                                <option>VIP</option>
                                <option>Luxury</option>

                            </select>

                        </div>

                        <!-- BUTTON -->
                        <button class="w-full bg-red-600 hover:bg-red-700 text-white py-5 rounded-2xl font-black text-xl shadow-xl transition">

                            Cari Tiket
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

</body>
</html>
