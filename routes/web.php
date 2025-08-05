<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LaporanPublikController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\PengajuanSuratController;

// =======================
// ✅ Home Page
// =======================
Route::get('/', [WargaController::class, 'index'])->name('beranda');

// =======================
// ✅ Pengajuan Surat
// =======================
Route::get('/pengajuan', [PengajuanSuratController::class, 'form'])->name('pengajuan.form');
Route::post('/pengajuan', [PengajuanSuratController::class, 'store'])->name('pengajuan.store');
Route::get('/pengajuan/riwayat', [PengajuanSuratController::class, 'riwayat'])->name('pengajuan.riwayat');
Route::get('/pengajuan/download/{id}', [PengajuanSuratController::class, 'download'])->name('pengajuan.download');

// =======================
// ✅ Laporan Warga (Publik) [SUDAH DIPINDAH]
// =======================
Route::get('/laporan-form', [LaporanPublikController::class, 'create'])->name('laporan.form');
Route::post('/laporan-form', [LaporanPublikController::class, 'store'])->name('laporan.store');
