@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow mt-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">📝 Form Pengajuan Surat</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pengajuan.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="nik" class="block text-sm font-semibold text-gray-700">NIK</label>
            <input type="text" name="nik" id="nik" class="w-full border p-2 rounded" value="{{ old('nik') }}" required>
            @error('nik') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="nama" class="block text-sm font-semibold text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" class="w-full border p-2 rounded" value="{{ old('nama') }}" required>
            @error('nama') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="jenis_surat_id" class="block text-sm font-semibold text-gray-700">Jenis Surat</label>
            <select name="jenis_surat_id" id="jenis_surat_id" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Jenis Surat --</option>
                @foreach ($jenisSurats as $jenis)
                    <option value="{{ $jenis->id }}" {{ old('jenis_surat_id') == $jenis->id ? 'selected' : '' }}>
                        {{ $jenis->nama }}
                    </option>
                @endforeach
            </select>
            @error('jenis_surat_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="keperluan" class="block text-sm font-semibold text-gray-700">Keperluan</label>
            <textarea name="keperluan" id="keperluan" rows="4" class="w-full border p-2 rounded" required>{{ old('keperluan') }}</textarea>
            @error('keperluan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Kirim Pengajuan
        </button>
    </form>
</div>
@endsection
