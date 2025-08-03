<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Laporan;

class LaporanPublikController extends Controller
{
    // Menampilkan form laporan publik
    public function create()
    {
        return view('laporan-form');
    }

    // Menyimpan laporan dari warga
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        // Cek apakah NIK sudah pernah mengirim, kalau belum buat data warga baru
        $warga = Warga::firstOrCreate(
            ['nik' => $request->nik],
            ['nama' => $request->nama, 'alamat' => '-', 'no_hp' => '-']
        );

        // Simpan laporan
        Laporan::create([
            'judul' => 'Laporan Warga', // Bisa diganti agar bisa custom dari input user
            'isi' => $request->isi,
            'warga_id' => $warga->id,
        ]);

        return redirect()->route('laporan.form')->with('success', 'Laporan berhasil dikirim.');
    }

    // Menampilkan halaman home dan laporan terbaru
    public function home()
    {
        $laporans = Laporan::with('warga')->latest()->take(5)->get(); // Ambil 5 laporan terbaru
        return view('home', compact('laporans'));
    }
}
