<div class="bg-white shadow-md rounded-lg p-8 w-full max-w-xl mx-auto mt-12">
    <h2 class="text-2xl font-bold mb-6 text-center text-green-700">📢 Form Laporan Warga</h2>

    @if(session('success_laporan'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success_laporan') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Ganti ke route yang benar --}}
    <form method="POST" action="{{ route('pengajuan.laporan-store') }}">
        @csrf

        <div class="mb-4">
            <label for="nama" class="block text-gray-700 font-medium mb-1">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                   class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <div class="mb-4">
            <label for="nik" class="block text-gray-700 font-medium mb-1">NIK</label>
            <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required
                   class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <div class="mb-4">
            <label for="isi" class="block text-gray-700 font-medium mb-1">Isi Laporan</label>
            <textarea name="isi" id="isi" rows="4" required
                      class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('isi') }}</textarea>
        </div>

        <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded font-semibold transition">
            Kirim Laporan
        </button>
    </form>
</div>
