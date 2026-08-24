<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daftarPengguna = [
            [
                'nama'     => 'Administrator',
                'username' => 'admin',
                'email'    => 'admin@sekolah.sch.id',
                'no_telp'  => '081200000001',
                'peran'    => 'admin', // Menggunakan huruf kecil sesuai Spatie Permission & Web Route
            ],
            [
                'nama'     => 'Petugas Laboratorium',
                'username' => 'petugas',
                'email'    => 'petugas@sekolah.sch.id',
                'no_telp'  => '081200000002',
                'peran'    => 'petugas',
            ],
            [
                'nama'     => 'Siswa Peminjam',
                'username' => 'peminjam',
                'email'    => 'peminjam@sekolah.sch.id',
                'no_telp'  => '081200000003',
                'peran'    => 'peminjam',
            ],
        ];

        foreach ($daftarPengguna as $data) {
            $pengguna = User::firstOrCreate(
                ['username' => $data['username']],
                [
                    'nama'     => $data['nama'],
                    'email'    => $data['email'],
                    'no_telp'  => $data['no_telp'],
                    'password' => bcrypt('password123'),
                    'is_aktif' => true,
                ]
            );

            // Menempelkan role Spatie ke akun pengguna
            $pengguna->syncRoles([$data['peran']]);
        }
    }
}