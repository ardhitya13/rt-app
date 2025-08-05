<!-- resources/views/laporan-form.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Laporan Warga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">📣 Form Laporan Warga</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('laporan.store') }}" method="POST">
            @csrf
            <input type="text" name="nama" placeholder="Nama" class="w-full mb-3 p-2 border rounded" required>
            <input type="text" name="nik" placeholder="NIK" class="w-full mb-3 p-2 border rounded" required>
            <input type="text" name="judul" placeholder="Judul (opsional)" class="w-full mb-3 p-2 border rounded">
            <textarea name="isi" placeholder="Isi laporan" class="w-full mb-3 p-2 border rounded" rows="4" required></textarea>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Kirim Laporan
            </button>
        </form>
    </div>
</body>
</html>
