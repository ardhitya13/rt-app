<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LaporanPublikController;

// Home page (beranda warga)
Route::get('/', function () {
    return view('home');
})->name('beranda');

// Form laporan warga (tanpa login)
Route::get('/', [WargaController::class, 'index'])->name('beranda'); // <- ini penting
Route::get('/lapor', [LaporanPublikController::class, 'create'])->name('laporan.form');
Route::post('/lapor', [LaporanPublikController::class, 'store'])->name('laporan.store');
