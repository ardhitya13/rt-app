<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Laporan;

class LaporanPublikController extends Controller
{
    /**
     * Tampilkan form laporan warga (di: resources/views/laporan-form.blade.php)
     */
    public function create()
    {
        return view('laporan-form');
    }

    /**
     * Simpan laporan dari warga
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'judul' => 'nullable|string|max:255',
            'isi' => 'required|string',
        ]);

        $warga = Warga::firstOrCreate(
            ['nik' => $request->nik],
            ['nama' => $request->nama, 'alamat' => '-', 'no_hp' => '-']
        );

        Laporan::create([
            'judul' => $request->judul ?: 'Laporan Warga',
            'isi' => $request->isi,
            'warga_id' => $warga->id,
        ]);

        return redirect()->route('laporan.form')->with('success', 'Laporan berhasil dikirim.');
    }

    /**
     * Tampilkan laporan terbaru di home
     */
    public function home()
    {
        $laporans = Laporan::with('warga')->latest()->take(5)->get();
        return view('home', compact('laporans'));
    }
}
