<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PeranIzinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daftarIzin = [
            // Izin milik Admin
            'user.kelola',
            'alat.kelola',
            'kategori.kelola',
            'peminjaman.kelola',
            'pengembalian.kelola',
            'log.lihat',
            'pengaturan.kelola',

            // Izin milik Petugas
            'peminjaman.setujui',
            'pengembalian.pantau',
            'laporan.cetak',

            // Izin milik Peminjam
            'alat.lihat',
            'peminjaman.ajukan',
            'peminjaman.kembalikan',
        ];

        // Membuat permission
        foreach ($daftarIzin as $namaIzin) {
            Permission::firstOrCreate([
                'name' => $namaIzin,
                'guard_name' => 'web',
            ]);
        }

        // Membuat role
        $peranAdmin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $peranPetugas = Role::firstOrCreate([
            'name' => 'petugas',
            'guard_name' => 'web',
        ]);

        $peranPeminjam = Role::firstOrCreate([
            'name' => 'peminjam',
            'guard_name' => 'web',
        ]);

        // Permission Admin
        $peranAdmin->syncPermissions([
            'user.kelola',
            'alat.kelola',
            'kategori.kelola',
            'peminjaman.kelola',
            'pengembalian.kelola',
            'log.lihat',
            'pengaturan.kelola',
        ]);

        // Permission Petugas
        $peranPetugas->syncPermissions([
            'peminjaman.setujui',
            'pengembalian.pantau',
            'laporan.cetak',
        ]);

        // Permission Peminjam
        $peranPeminjam->syncPermissions([
            'alat.lihat',
            'peminjaman.ajukan',
            'peminjaman.kembalikan',
        ]);
    }
}