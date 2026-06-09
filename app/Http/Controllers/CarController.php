<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

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
            'nama_mobil' => 'required|string|max:255',
            'plat_nomor' => 'required|string|max:100',
            'harga_dasar' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:2048',
            'status' => 'nullable|in:tersedia,disewa',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')
                ->store('cars', 'public');
        }

        Car::create(array_filter($validated, function ($value) {
            return $value !== null;
        }));

        return redirect()->route('cars.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
