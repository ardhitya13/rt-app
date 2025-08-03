<?php

namespace App\Filament\Pages;

use App\Models\Warga;
use App\Models\Laporan;
use Filament\Pages\Page;

class DashboardAdmin extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard-admin';
    protected static ?string $title = 'Dashboard Admin';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $navigationGroup = 'RT Admin';

    public function getViewData(): array
    {
        // Ambil data laporan per bulan
        $laporanBulanan = Laporan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $labels = [];
        $values = [];

        foreach (range(1, 12) as $bulan) {
            $labels[] = date('F', mktime(0, 0, 0, $bulan, 1));
            $data = $laporanBulanan->firstWhere('bulan', $bulan);
            $values[] = $data ? $data->total : 0;
        }

        return [
            'jumlahWarga' => Warga::count(),
            'jumlahLaporan' => Laporan::count(),
            'laporanTerbaru' => Laporan::with('warga')->latest()->take(5)->get(),
            'chartLabels' => $labels,
            'chartData' => $values,
        ];
    }
}
