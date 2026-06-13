<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mobil'  => 'required|string|max:255',
            'plat_nomor'  => 'required|string|max:100',
            'harga_dasar' => 'required|integer|min:0',
            'stok'        => 'nullable|integer|min:0',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'      => 'nullable|in:tersedia,disewa',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('cars', 'public');
        }

        Car::create($validated);

        return redirect()
            ->route('cars.index')
            ->with('success', 'Mobil berhasil ditambahkan');
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'nama_mobil'  => 'required|string|max:255',
            'plat_nomor'  => 'required|string|max:100',
            'harga_dasar' => 'required|integer|min:0',
            'stok'        => 'required|integer|min:0',
            'status'      => 'nullable|in:tersedia,disewa',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {

            if ($car->gambar && Storage::disk('public')->exists($car->gambar)) {
                Storage::disk('public')->delete($car->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('cars', 'public');
        }

        $car->update($validated);

        return redirect()
            ->route('cars.index')
            ->with('success', 'Mobil berhasil diperbarui');
    }

    public function destroy(Car $car)
    {
    if ($car->gambar && Storage::disk('public')->exists($car->gambar)) {
        Storage::disk('public')->delete($car->gambar);
    }

    $car->delete(); // cukup ini sebenarnya

    return response()->json([
        'message' => 'deleted'
    ]);
    }
}