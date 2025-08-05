<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Umum</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12pt; margin: 40px; }
        .center { text-align: center; }
        .judul { font-size: 18pt; font-weight: bold; text-decoration: underline; }
        .signature { margin-top: 60px; text-align: right; }
    </style>
</head>
<body>

    <div class="center">
        <p class="judul">SURAT KETERANGAN</p>
        <p>Nomor: {{ $pengajuan->id }}/SKU/{{ date('Y') }}</p>
    </div>

    <p>Yang bertanda tangan di bawah ini, Ketua RT 003 RW 002 Kelurahan Tanjung Sengkuang, Kecamatan Batu Ampar, Kota Batam, menerangkan bahwa:</p>

    <table style="margin-left: 20px; margin-top: 10px;">
        <tr><td width="150">Nama</td><td>: {{ $pengajuan->nama }}</td></tr>
        <tr><td>NIK</td><td>: {{ $pengajuan->nik }}</td></tr>
    </table>

    <p style="margin-top: 10px;">Adalah benar warga yang berdomisili di wilayah RT 003 RW 002, Kelurahan Tanjung Sengkuang, Kecamatan Batu Ampar, Kota Batam.</p>

    <p>Surat ini dibuat untuk keperluan: <strong>{{ $pengajuan->keperluan ?? '-' }}</strong>.</p>

    <p>Demikian surat ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</p>

    <div class="signature">
        <p>Batam, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p style="margin-bottom: 60px;">Ketua RT 003 / RW 002</p>
        <p><strong>______________________</strong></p>
    </div>

</body>
</html>
