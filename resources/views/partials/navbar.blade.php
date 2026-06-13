<!-- TOP BAR -->
<div class="relative z-50 bg-white text-xs md:text-sm py-2 border-b hidden md:block">

    <div class="max-w-7xl mx-auto flex justify-end gap-6 md:gap-10 px-6 text-slate-600">

        <p>Email:
            admin@rentaltravel.com
        </p>

        <p>Customer Service:
            0812-3456-7890
        </p>

    </div>

</div>

<style>

    .mobile-menu{display:none;width:100%;left:0;box-sizing:border-box}
    .mobile-menu.show{display:block;position:relative;z-index:60;width:100%;}
</style>

<!-- NAVBAR -->
<nav class="relative z-50 bg-gradient-to-r from-slate-900 via-red-900 to-red-700 text-white shadow-xl">

    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between py-5 gap-4">

            <div class="min-w-0 flex-1 flex items-center gap-4">

                <!-- LOGO -->
                <div class="min-w-0">

                    <h1 class="text-4xl font-black tracking-wide">
                        CLIFT<span class="text-red-500">TRAVELINDO</span>
                    </h1>

                    <p class="text-sm text-slate-300">
                        Antar Kota & Rental Mobil
                    </p>

                </div>
            </div>

            <!-- NAV MENU -->
            <div class="hidden lg:flex gap-8 font-semibold items-center">

               <a href="{{ url('/') }}">Beranda</a>
               <a href="{{ route('rental.mobil') }}">Rental Mobil</a>
               <a href="{{ url('/tiket-travel') }}">Tiket Travel</a>
               <a href="{{ url('/promo') }}">Promo</a>
               <a href="{{ url('/tentang-kami') }}">Tentang Kami</a>

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-2xl text-white font-bold">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/auth/google" class="hover:text-red-400 transition">Login</a>
                @endauth

            </div>

            <!-- MENU TOGGLER -->
            <div class="lg:hidden flex-shrink-0">
                <button id="mobileToggler" aria-label="Menu" class="flex items-center justify-center p-2 sm:p-3 rounded-xl bg-white border border-slate-200 shadow-sm hover:bg-slate-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" viewBox="0 0 24 24" fill="none">
                        <rect x="4" y="6" width="16" height="2" rx="1" fill="#111827" />
                        <rect x="4" y="11" width="16" height="2" rx="1" fill="#111827" />
                        <rect x="4" y="16" width="16" height="2" rx="1" fill="#111827" />
                    </svg>
                </button>
            </div>

        </div>

    </div>

</nav>

<!-- MOBILE MENU -->
<div id="mobileMenu" class="mobile-menu lg:hidden bg-white border-b relative z-50">
    <div class="px-6 py-4 space-y-3">
        <a href="{{ url('/') }}" class="block font-semibold">Beranda</a>
        <a href="{{ route('rental.mobil') }}" class="block font-semibold">Rental Mobil</a>
        <a href="{{ url('/tiket-travel') }}" class="block font-semibold">Tiket Travel</a>
        <a href="{{ url('/promo') }}" class="block font-semibold">Promo</a>
        <a href="{{ url('/tentang-kami') }}" class="block font-semibold">Tentang Kami</a>
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 px-4 py-2 rounded-2xl text-white font-bold">Logout</button>
            </form>
        @else
            <a href="/auth/google" class="block font-semibold">Login</a>
        @endauth
    </div>
</div>

<script>
    document.getElementById('mobileToggler')?.addEventListener('click', function(){
        document.getElementById('mobileMenu').classList.toggle('show');
    });
</script>
