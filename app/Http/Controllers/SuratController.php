<?php

namespace App\Http\Controllers;

use App\Models\Pengajuansurat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // <- Penting

class SuratController extends Controller
{
    public function download($id)
    {
        $pengajuan = Pengajuansurat::with(['warga', 'jenisSurat'])->findOrFail($id);

        $data = [
            'pengajuan' => $pengajuan,
            'warga' => $pengajuan->warga,
            'jenis' => $pengajuan->jenisSurat,
        ];

        switch ($pengajuan->jenis_surat_id) {
            case 1:
                $pdf = Pdf::loadView('pdf.surat-domisili', $data);
                $filename = 'surat_domisili.pdf';
                break;

            case 2:
                $pdf = Pdf::loadView('pdf.surat-miskin', $data);
                $filename = 'surat_keterangan_miskin.pdf';
                break;

            case 3:
                $pdf = Pdf::loadView('pdf.surat-umum', $data);
                $filename = 'surat_keterangan_umum.pdf';
                break;

            default:
                return abort(404, 'Template surat belum tersedia.');
        }

        return $pdf->download($filename);
    }
}
