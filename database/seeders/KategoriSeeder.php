<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daftarKategori = [
        ['nama' =>'Perkakas Tangan', 'deskripsi' => 'Obeng, tang, kunci, palu'],
        ['nama' => 'Alat Ukur', 'deskripsi' => 'Multimeter, jangka sorong, mistar'],
        ['nama' => 'Perangkat Jaringan', 'deskripsi' => 'Switch, router, tang crimping'],
        ['nama' => 'Perangkat Audio Visual', 'deskripsi' => 'Proyektor, kamera, tripod'],
        ];
        foreach ($daftarKategori as $data) {
            \App\Models\Kategori::firstOrCreate(
                ['nama' => $data['nama']],
                ['deskripsi' => $data['deskripsi']]
            );
        }
    }
}
        
