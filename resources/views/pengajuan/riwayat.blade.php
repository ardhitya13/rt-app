@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Riwayat Pengajuan Surat</h2>

        <form method="GET" action="{{ route('pengajuan.riwayat') }}" class="mb-4">
            <input type="text" name="nik" value="{{ $nik ?? '' }}" placeholder="Masukkan NIK"
                   class="border p-2 rounded w-1/2" required>
            <button class="bg-blue-600 text-white px-4 py-2 rounded ml-2">Cari</button>
        </form>

        @if (count($riwayats ?? []))
            <table class="w-full table-auto text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Jenis Surat</th>
                        <th class="px-4 py-2">Keperluan</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayats as $item)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $item->jenisSurat->nama }}</td>
                            <td class="px-4 py-2">{{ $item->keperluan }}</td>
                            <td class="px-4 py-2">{{ $item->status }}</td>
                            <td class="px-4 py-2">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('pengajuan.download', $item->id) }}" class="text-blue-500 underline">Download</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500 mt-4">Tidak ada pengajuan ditemukan untuk NIK tersebut.</p>
        @endif
    </div>
@endsection
