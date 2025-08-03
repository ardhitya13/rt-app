<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Laporan Warga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md mt-8">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-700">Form Laporan Warga</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="text-sm">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('laporan.store') }}">
            @csrf

            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-medium mb-1">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="nik" class="block text-gray-700 font-medium mb-1">NIK</label>
                <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="isi" class="block text-gray-700 font-medium mb-1">Isi Laporan</label>
                <textarea name="isi" id="isi" rows="4" required class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-500">{{ old('isi') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-semibold">
                Kirim Laporan
            </button>
        </form>
    </div>

</body>
</html>
