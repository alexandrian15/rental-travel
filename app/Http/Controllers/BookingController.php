<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Services\DynamicPricingService;
use Carbon\Carbon;
use App\Models\CarAvailability;
use Barryvdh\DomPDF\Facade\Pdf;


class BookingController extends Controller
{
    public function create(Car $car)
    {
        return view('bookings.create', compact('car'));
    }

    public function store(
        Request $request,
        Car $car,
        DynamicPricingService $pricing
    ) {
        $request->validate([
            'nama_pemesan'     => 'required',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $totalHarga = $pricing->calculate(
            $car,
            $request->tanggal_mulai,
            $request->tanggal_selesai
        );

        $tanggal = Carbon::parse($request->tanggal_mulai);

while (
    $tanggal <= Carbon::parse($request->tanggal_selesai)
) {

    $availability = CarAvailability::where(
        'car_id',
        $car->id
    )
    ->whereDate(
        'tanggal',
        $tanggal
    )
    ->first();

    if (
        $availability &&
        $availability->unit_terpakai >= $car->stok
    ) {
        return back()->withErrors([
            'tanggal_mulai' =>
            'Unit habis pada tanggal '.$tanggal->format('d-m-Y')
        ]);
    }

    $tanggal->addDay();
}

        $booking = Booking::create([
    'car_id' => $car->id,
    'nama_pemesan' => $request->nama_pemesan,
    'tanggal_mulai' => $request->tanggal_mulai,
    'tanggal_selesai' => $request->tanggal_selesai,
    'total_harga' => $totalHarga,
    'payment_status' => 'paid',
    'booking_status' => 'confirmed',
]);

$tanggal = Carbon::parse($request->tanggal_mulai);

while (
    $tanggal <= Carbon::parse($request->tanggal_selesai)
) {

    $availability = CarAvailability::firstOrCreate([
        'car_id' => $car->id,
        'tanggal' => $tanggal->format('Y-m-d')
    ]);

    $availability->increment('unit_terpakai');

    $tanggal->addDay();
}

return redirect()->route('payment.show', [
    'booking' => $booking->id
]);
    }

public function showPayment(Booking $booking)
{
    return view(
        'bookings.payment',
        compact('booking')
    );
}

public function processPayment(
    Booking $booking
)
{
    $booking->update([
        'payment_status' => 'paid',
        'booking_status' => 'confirmed'
    ]);

    return redirect()
        ->route(
            'booking.success',
            $booking->id
        );
}
public function cekHarga(
    Request $request,
    Car $car,
    DynamicPricingService $pricing
)
{
    $harga = $pricing->calculate(
        $car,
        $request->tanggal_mulai,
        $request->tanggal_selesai
    );

    return response()->json([
        'harga' => $harga,
        'mobil' => $car->nama_mobil,
    ]);
}

    public function availability(Car $car)
    {
        return Booking::where('car_id', $car->id)
            ->get([
                'tanggal_mulai',
                'tanggal_selesai'
            ]);
    }

    public function unavailableDates(Car $car)
{
    return \App\Models\CarAvailability::where(
        'car_id',
        $car->id
    )
    ->whereColumn(
        'unit_terpakai',
        '>=',
        \DB::raw($car->stok)
    )
    ->pluck('tanggal');
}


    public function success(Booking $booking)
{
    return view(
        'bookings.success',
        compact('booking')
    );
}

public function payment(Booking $booking)
{
    return view(
        'bookings.payment',
        compact('booking')
    );
}


public function confirmPayment(Booking $booking)
{
    $booking->update([
        'payment_status' => 'paid',
        'booking_status' => 'confirmed',
    ]);

    return redirect()->route(
        'booking.success',
        $booking->id
    );
}


public function downloadPdf(Booking $booking)
{
    $pdf = Pdf::loadView(
        'bookings.invoice',
        compact('booking')
    );

    return $pdf->download(
        'booking-'.$booking->id.'.pdf'
    );
}
    public function show(Booking $booking)
    {
        //
    }

    public function edit(Booking $booking)
    {
        //
    }

    public function update(Request $request, Booking $booking)
    {
        //
    }

    public function destroy(Booking $booking)
    {
        //
    }

    public function booking(Request $request, Travel $travel)
{
    $request->validate([
        'nama_pemesan' => 'required',
        'jumlah_kursi' => 'required|integer|min:1',
    ]);

    DB::transaction(function () use ($request, $travel) {

        // lock data biar tidak double booking
        $travel = Travel::where('id', $travel->id)->lockForUpdate()->first();

        $sisa = $travel->kursi_total - $travel->kursi_terisi;

        if ($request->jumlah_kursi > $sisa) {
            abort(400, 'Kursi tidak cukup');
        }

        TravelBooking::create([
            'travel_id' => $travel->id,
            'nama_pemesan' => $request->nama_pemesan,
            'jumlah_kursi' => $request->jumlah_kursi,
            'tanggal' => $travel->tanggal,
        ]);

        $travel->increment('kursi_terisi', $request->jumlah_kursi);
    });

    return redirect()->route('travel.success');
}
}