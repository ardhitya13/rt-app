<x-filament::page>
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin RT</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <x-filament::card>
            <p class="text-lg font-semibold">👥 Jumlah Warga</p>
            <p class="text-3xl text-primary">{{ $jumlahWarga }}</p>
        </x-filament::card>

        <x-filament::card>
            <p class="text-lg font-semibold">📢 Jumlah Laporan</p>
            <p class="text-3xl text-danger">{{ $jumlahLaporan }}</p>
        </x-filament::card>

        <x-filament::card>
            <p class="text-lg font-semibold">📄 Pengajuan Surat</p>
            <p class="text-3xl text-success">{{ $jumlahPengajuanSurat }}</p>
        </x-filament::card>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <x-filament::card>
            <h3 class="text-lg font-semibold mb-4">📈 Grafik Jumlah Laporan Bulanan</h3>
            <canvas id="laporanChart" height="200"></canvas>
        </x-filament::card>

        <x-filament::card>
            <h3 class="text-lg font-semibold mb-4">📊 Status Pengajuan Surat</h3>
            <canvas id="suratChart" height="200"></canvas>
        </x-filament::card>
    </div>

    <x-filament::card>
        <h3 class="text-lg font-semibold mb-4">🕒 Laporan Warga Terbaru</h3>
        <table class="min-w-full table-auto text-sm">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2">Nama Warga</th>
                    <th class="px-4 py-2">Judul</th>
                    <th class="px-4 py-2">Isi</th>
                    <th class="px-4 py-2">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporanTerbaru as $laporan)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $laporan->warga->nama ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $laporan->judul }}</td>
                        <td class="px-4 py-2">{{ \Illuminate\Support\Str::limit($laporan->isi, 50) }}</td>
                        <td class="px-4 py-2">{{ $laporan->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Belum ada laporan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-filament::card>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart laporan bulanan
        const laporanCtx = document.getElementById('laporanChart').getContext('2d');
        new Chart(laporanCtx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Jumlah Laporan',
                    data: @json($chartData),
                    backgroundColor: '#3b82f6',
                    borderColor: '#1d4ed8',
                    borderWidth: 1,
                    borderRadius: 6,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Chart status surat
        const suratCtx = document.getElementById('suratChart').getContext('2d');
        new Chart(suratCtx, {
            type: 'doughnut',
            data: {
                labels: @json(array_keys($suratStatus)),
                datasets: [{
                    label: 'Status Surat',
                    data: @json(array_values($suratStatus)),
                    backgroundColor: ['#f59e0b', '#10b981', '#ef4444'],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</x-filament::page>
