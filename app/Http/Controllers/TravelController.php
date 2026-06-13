<?php

namespace App\Http\Controllers;


use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function index()
    {
        return view('travel.index');
    }

    public function search(Request $request)
    {
        $request->validate([
        'asal' => 'required',
        'tujuan' => 'required',
        'tanggal' => 'required|date',
    ]);

    $travels = Travel::where('asal', $request->asal)
        ->where('tujuan', $request->tujuan)
        ->whereDate('tanggal', $request->tanggal)
        ->whereRaw('kursi_terisi < kursi_total') // 🔥 penting
        ->get();

    return view('travel.result', compact('travels'));
    }

}