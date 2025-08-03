<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Selamat Datang di RT Kita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
</head>

<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-600">RT App</h1>
        <a href="{{ route('laporan.form') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Isi Laporan
        </a>
    </nav>

    <!-- Gambar Slider -->
    <div class="my-6 max-w-5xl mx-auto">
        <div class="swiper rounded-lg overflow-hidden shadow-lg">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('images/slider1.png') }}" class="w-full" alt="Lingkungan RT 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/slider2.png') }}" class="w-full" alt="Warga Berkumpul">
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('images/slider3.png') }}" class="w-full" alt="Gotong Royong">
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Info RT -->
    <section class="max-w-5xl mx-auto my-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">📰 Info & Berita RT</h2>

        @if ($infos->count())
            @foreach ($infos as $info)
                <article class="mb-5 border-b pb-4">
                    <h3 class="font-semibold text-lg">📌 {{ $info->judul }}</h3>
                    <p class="text-gray-500 text-sm">Tanggal:
                        {{ \Carbon\Carbon::parse($info->tanggal)->translatedFormat('d F Y') }}</p>
                    <p class="mt-2 text-gray-700">{{ $info->isi }}</p>
                </article>
            @endforeach
        @else
            <p class="text-gray-500 text-sm">Belum ada info terbaru dari RT.</p>
        @endif
    </section>

    <!-- Laporan Warga -->
    <section class="max-w-5xl mx-auto my-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">📢 Laporan Warga Terbaru</h2>

        @if (isset($laporans) && $laporans->count())
            <ul class="space-y-5">
                @foreach ($laporans as $laporan)
                    <li class="border-l-4 border-green-600 pl-4 py-2 bg-gray-50 rounded">
                        <div class="flex justify-between items-center">
                            <h3 class="font-semibold text-lg text-gray-900">{{ $laporan->judul }}</h3>
                            <span class="text-sm text-gray-500">{{ $laporan->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <p class="text-sm text-gray-700 mt-1">{{ \Illuminate\Support\Str::limit($laporan->isi, 120) }}
                        </p>
                        <p class="text-xs text-gray-500 italic">Oleh: {{ $laporan->warga->nama }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600 text-sm">Belum ada laporan yang masuk.</p>
        @endif
    </section>

    <!-- Tombol Laporan -->
    <div class="text-center my-8">
        <a href="{{ route('laporan.form') }}"
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded text-lg">
            Kirim Laporan Sekarang
        </a>
    </div>

    <!-- Footer -->
    <footer class="bg-white text-center text-gray-500 text-sm py-4 mt-12 shadow-inner">
        &copy; {{ date('Y') }} RT App - Sistem Informasi RT
    </footer>

    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            autoplay: {
                delay: 3000
            },
            pagination: {
                el: '.swiper-pagination'
            },
        });
    </script>
</body>

</html>
