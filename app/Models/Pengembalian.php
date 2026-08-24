<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjaman_id',
        'petugas_id',
        'tgl_kembali',
        'status',
        'denda_kerusakan',
        'catatan',
    ];

    protected $casts = [
        'tgl_kembali' => 'date', // <-- Sesuaikan dari tgl_pengembalian ke tgl_kembali
    ];

    /**
     * Relasi ke model Peminjaman
     */
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    /**
     * Relasi ke model User (Petugas)
     */
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}