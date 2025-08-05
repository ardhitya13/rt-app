<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use App\Models\JenisSurat;
use App\Models\User;
use App\Models\Laporan;
use App\Models\Warga;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Notification;

class PengajuanSuratController extends Controller
{
    /**
     * Tampilkan form pengajuan surat
     */
    public function form()
    {
        $jenisSurats = JenisSurat::all();
        return view('pengajuan.form', compact('jenisSurats'));
    }

    /**
     * Simpan pengajuan surat dan kirim notifikasi admin
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'nama' => 'required|string',
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'keperluan' => 'nullable|string',
        ]);

        $pengajuan = PengajuanSurat::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenis_surat_id' => $request->jenis_surat_id,
            'keperluan' => $request->keperluan,
            'status' => 'Diproses',
        ]);

        // Notifikasi untuk semua admin
        $admins = User::all();
        foreach ($admins as $admin) {
            Notification::make()
                ->title('Pengajuan Surat Baru')
                ->body("Pengajuan dari <strong>{$pengajuan->nama}</strong> untuk surat <strong>{$pengajuan->jenisSurat->nama}</strong> telah masuk.")
                ->success()
                ->sendToDatabase($admin);
        }

        return redirect('/')->with('success', 'Pengajuan berhasil dikirim.');
    }

    /**
     * Unduh PDF berdasarkan jenis surat
     */
    public function download($id)
    {
        $pengajuan = PengajuanSurat::with('jenisSurat')->findOrFail($id);

        $warga = (object)[
            'nama' => $pengajuan->nama,
            'nik' => $pengajuan->nik,
            'alamat' => 'RT 003 / RW 002, Kelurahan Tanjung Sengkuang, Kecamatan Batu Ampar',
        ];

        $data = compact('pengajuan', 'warga');

        switch ($pengajuan->jenis_surat_id) {
            case 1:
                $pdf = Pdf::loadView('pdf.surat-domisili', $data);
                $filename = 'surat_domisili.pdf';
                break;
            case 2:
                $pdf = Pdf::loadView('pdf.surat-miskin', $data);
                $filename = 'surat_miskin.pdf';
                break;
            case 3:
                $pdf = Pdf::loadView('pdf.surat-umum', $data);
                $filename = 'surat_umum.pdf';
                break;
            default:
                abort(404, 'Template surat tidak ditemukan.');
        }

        return $pdf->download($filename);
    }

    /**
     * Tampilkan riwayat pengajuan berdasarkan NIK
     */
    public function riwayat(Request $request)
    {
        $nik = $request->query('nik');

        $riwayats = [];
        if ($nik) {
            $riwayats = PengajuanSurat::with('jenisSurat')
                ->where('nik', $nik)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('pengajuan.riwayat', compact('riwayats', 'nik'));
    }

    /**
     * Tampilkan form laporan warga
     */
    public function laporanForm()
    {
        return view('pengajuan.laporan-form');
    }

    /**
     * Simpan laporan warga
     */
    public function laporanStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'isi' => 'required|string',
        ]);

        // Cari atau buat warga
        $warga = Warga::firstOrCreate(
            ['nik' => $request->nik],
            ['nama' => $request->nama, 'alamat' => '-', 'no_hp' => '-']
        );

        // Simpan laporan
        Laporan::create([
            'judul' => 'Laporan Warga',
            'isi' => $request->isi,
            'warga_id' => $warga->id,
        ]);

        // Redirect ke halaman form laporan lagi dengan notifikasi
        return redirect()->route('pengajuan.laporan')->with('success', 'Laporan berhasil dikirim.');
    }
}
