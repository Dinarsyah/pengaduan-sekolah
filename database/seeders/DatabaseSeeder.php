<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==================== USER ====================
        // Admin
        User::create([
            'nama' => 'Admin Sekolah',
            'email' => 'admin@sekolah.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Guru
        User::create([
            'nama' => 'Budi Guru',
            'email' => 'guru@sekolah.com',
            'password' => bcrypt('password'),
            'role' => 'guru'
        ]);

        // Siswa 1
        User::create([
            'nama' => 'Ahmad Siswa',
            'email' => 'siswa@sekolah.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);

        // Siswa 2
        User::create([
            'nama' => 'Siti Siswa',
            'email' => 'siswa2@sekolah.com',
            'password' => bcrypt('password'),
            'role' => 'siswa'
        ]);

        // ==================== KATEGORI ====================
        Kategori::create(['nama_kategori' => 'Fasilitas Sekolah']);
        Kategori::create(['nama_kategori' => 'Guru/Pengajar']);
        Kategori::create(['nama_kategori' => 'Keuangan/SPP']);
        Kategori::create(['nama_kategori' => 'Kurikulum']);
        Kategori::create(['nama_kategori' => 'Lainnya']);
    }
}
