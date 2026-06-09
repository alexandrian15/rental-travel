@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    <div class="mb-4">
        <h2 class="fw-bold">Dashboard Admin</h2>
        <p class="text-muted">
            Ringkasan aktivitas rental mobil
        </p>
    </div>

    <div class="row g-4">

        <!-- Total Booking -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">
                        Total Booking
                    </h6>

                    <h2 class="fw-bold">
                        {{ $totalBooking }}
                    </h2>
                </div>
            </div>
        </div>

        <!-- Pendapatan -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">
                        Total Pendapatan
                    </h6>

                    <h2 class="fw-bold text-success">
                        Rp {{ number_format($totalPendapatan,0,',','.') }}
                    </h2>
                </div>
            </div>
        </div>

        <!-- Total Mobil -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">
                        Total Mobil
                    </h6>

                    <h2 class="fw-bold">
                        {{ $totalMobil }}
                    </h2>
                </div>
            </div>
        </div>

        <!-- Mobil Tersedia -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">
                        Mobil Tersedia
                    </h6>

                    <h2 class="fw-bold text-primary">
                        {{ $mobilTersedia }}
                    </h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Statistik Bulan Ini -->
    <div class="row mt-4 g-4">

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <h5 class="mb-3">
                        Statistik Bulan Ini
                    </h5>

                    <p>
                        Booking :
                        <strong>
                            {{ $bookingBulanIni }}
                        </strong>
                    </p>

                    <p>
                        Pendapatan :
                        <strong class="text-success">
                            Rp {{ number_format($pendapatanBulanIni,0,',','.') }}
                        </strong>
                    </p>

                    <p>
                        Mobil Dibooking :
                        <strong>
                            {{ $mobilDibooking }}
                        </strong>
                    </p>

                </div>
            </div>
        </div>

        <!-- Mobil Terlaris -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <h5 class="mb-3">
                        Mobil Terlaris
                    </h5>

                    @if($mobilTerlaris)

                        <h3 class="fw-bold text-primary">
                            {{ $mobilTerlaris->car->nama_mobil }}
                        </h3>

                        <p class="text-muted">
                            Total Booking :
                            {{ $mobilTerlaris->total_booking }}
                        </p>

                    @else

                        <p>
                            Belum ada data booking.
                        </p>

                    @endif

                </div>
            </div>
        </div>

    </div>

    <!-- Booking Terbaru -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                Booking Terbaru
            </h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>Pemesan</th>
                            <th>Mobil</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($bookingTerbaru as $booking)

                        <tr>

                            <td>
                                {{ $booking->nama_pemesan }}
                            </td>

                            <td>
                                {{ $booking->car->nama_mobil }}
                            </td>

                            <td>
                                {{ $booking->tanggal_mulai }}
                            </td>

                            <td>
                                {{ $booking->tanggal_selesai }}
                            </td>

                            <td>
                                Rp {{ number_format($booking->total_harga,0,',','.') }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center">
                                Belum ada booking
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

@endsection