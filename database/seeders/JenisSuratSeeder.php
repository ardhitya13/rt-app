<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSuratSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jenis_surats')->insert([
            [
                'nama' => 'Surat Domisili',
                'keterangan' => 'Digunakan sebagai bukti domisili warga di wilayah RT.',
            ],
            [
                'nama' => 'Surat Keterangan Tidak Mampu',
                'keterangan' => 'Digunakan untuk keperluan bantuan sosial atau sekolah.',
            ],
            [
                'nama' => 'Surat Keterangan Umum',
                'keterangan' => 'Untuk keperluan surat-surat umum lainnya.',
            ],
        ]);
    }
}
