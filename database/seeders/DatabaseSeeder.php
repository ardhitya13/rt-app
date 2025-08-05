<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin jika belum ada
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin RT',
                'password' => Hash::make('12345678'), // password default
            ]
        );

        // Panggil seeder lainnya
        $this->call([
            JenisSuratSeeder::class,
        ]);
    }
}
