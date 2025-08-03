<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Laporan;
use App\Models\Info;

class WargaController extends Controller
{
    // Halaman utama
    public function index()
    {
        $laporans = Laporan::with('warga')->latest()->limit(5)->get();
        $infos = Info::latest()->limit(5)->get();

        return view('home', compact('laporans', 'infos'));
    }

    // Simpan laporan
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string',
        ]);

        $warga = Warga::firstOrCreate(
            ['nik' => $request->nik],
            [
                'nama' => $request->nama,
                'alamat' => $request->alamat ?? '-',
                'no_hp' => $request->no_hp ?? '-',
            ]
        );

        Laporan::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'warga_id' => $warga->id,
        ]);

        return redirect('/')->with('success', 'Laporan berhasil dikirim.');
    }
}
