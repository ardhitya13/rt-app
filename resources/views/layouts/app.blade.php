<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'RT App')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tambahan styling -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <div>
            <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">RT App</a>
        </div>
        <div class="space-x-4">
            <a href="{{ route('pengajuan.form') }}" class="text-gray-600 hover:text-blue-600">Ajukan Surat</a>
            <a href="{{ route('pengajuan.riwayat') }}" class="text-gray-600 hover:text-blue-600">Riwayat Surat</a>
            <a href="{{ route('laporan.form') }}" class="text-gray-600 hover:text-blue-600">Kirim Laporan</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white text-center text-gray-500 text-sm py-4 shadow-inner">
        &copy; {{ date('Y') }} RT App - Sistem Informasi RT
    </footer>

</body>

</html>
