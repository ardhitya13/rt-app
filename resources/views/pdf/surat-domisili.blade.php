<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Domisili</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.6;
        }
        .text-center {
            text-align: center;
        }
        .signature {
            margin-top: 60px;
            text-align: right;
        }
        .header {
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .content {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="header text-center">
        <h3>PEMERINTAH KOTA BATAM</h3>
        <h4>KECAMATAN BATU AMPAR - KELURAHAN TANJUNG SENGKUANG</h4>
        <h4>RUKUN TETANGGA (RT) 003 / RW 002</h4>
        <p><em>Alamat RT: Jl. Contoh Alamat, Kelurahan Tanjung Sengkuang</em></p>
    </div>

    <div class="text-center">
        <h2><u>SURAT KETERANGAN DOMISILI</u></h2>
        <p>Nomor: 003/RT003-DOMISILI/{{ date('Y') }}</p>
    </div>

    <div class="content">
        <p>Yang bertanda tangan di bawah ini, Ketua RT 003 RW 002, Kelurahan Tanjung Sengkuang, Kecamatan Batu Ampar, Kota Batam, menerangkan bahwa:</p>

        <table style="margin-left: 20px; margin-top: 10px;">
            <tr>
                <td width="150">Nama</td>
                <td>: {{ $pengajuan->nama }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $pengajuan->nik }}</td>
            </tr>
            <tr>
                <td>Keperluan</td>
                <td>: {{ $pengajuan->keperluan ?? '-' }}</td>
            </tr>
        </table>

        <p style="margin-top: 15px;">
            Adalah benar warga yang berdomisili di wilayah RT 003 RW 002, Kelurahan Tanjung Sengkuang, Kecamatan Batu Ampar, Kota Batam.
        </p>

        <p>
            Demikian surat ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.
        </p>
    </div>

    <div class="signature">
        <p>Batam, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p style="margin-bottom: 60px;">Ketua RT 003 / RW 002</p>
        <p><strong>______________________</strong></p>
    </div>

</body>
</html>
