<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;    
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\PengembalianController; 
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\LaporanController;

// Redirect halaman utama langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Group route yang membutuhkan autentikasi (harus login terlebih dahulu)
Route::middleware(['auth'])->group(function () {

    // Dasbor Admin
    Route::get('/admin/dasbor', function () {
        return view('dasbor.admin');
    })->middleware('role:admin')->name('admin.dasbor');

    // Dasbor Petugas
    Route::get('/petugas/dasbor', function () {
        return view('dasbor.petugas');
    })->middleware('role:petugas')->name('petugas.dasbor');

    // Dasbor Peminjam
    Route::get('/peminjam/dasbor', function () {
        return view('dasbor.peminjam');
    })->middleware('role:peminjam')->name('peminjam.dasbor');

    Route::resource('kategori', KategoriController::class)
    ->except(['show'])
    ->middleware('permission:kategori.kelola');
    Route::resource('alat', AlatController::class)
    ->except(['show'])
    ->middleware('permission:alat.kelola');
    Route::resource('pengguna', PenggunaController::class)
    ->except(['show'])
    ->middleware('permission:user.kelola');
    Route::middleware('permission:alat.lihat')
    ->prefix('katalog')
    ->name('katalog.')
    ->group(function () {
        Route::get('/', [KatalogController::class, 'katalog'])->name('daftar');
        Route::get('/keranjang', [KatalogController::class, 'lihatKeranjang'])->name('keranjang');
        Route::post('/{alat}/tambah', [KatalogController::class, 'tambahKeKeranjang'])->name('tambah');
        Route::put('/{alat}/jumlah', [KatalogController::class, 'ubahJumlah'])->name('ubah-jumlah');
        Route::delete('/{alatId}/hapus', [KatalogController::class, 'hapusDariKeranjang'])->name('hapus');
        Route::delete('/kosongkan', [KatalogController::class, 'kosongkanKeranjang'])->name('kosongkan');
});
Route::middleware('permission:peminjaman.ajukan')
    ->prefix('peminjaman')
    ->name('peminjaman.')
    ->group(function () {
        Route::get('/form', [PeminjamanController::class, 'formPengajuan'])->name('form');
        Route::post('/simpan', [PeminjamanController::class, 'simpanPengajuan'])->name('simpan');
        Route::get('/saya', [PeminjamanController::class, 'daftarSaya'])->name('saya');
        Route::get('/{peminjaman}', [PeminjamanController::class, 'rincian'])->name('rincian');
});
Route::middleware('permission:peminjaman.setujui')
    ->prefix('persetujuan')
    ->name('persetujuan.')
    ->group(function () {
        Route::get('/', [PersetujuanController::class, 'antrian'])->name('antrian');
        Route::get('/{peminjaman}', [PersetujuanController::class, 'rincian'])->name('rincian');
        Route::post('/{peminjaman}/setujui', [PersetujuanController::class, 'setujui'])->name('setujui');
        Route::post('/{peminjaman}/tolak', [PersetujuanController::class, 'tolak'])->name('tolak');
    });
    Route::middleware('permission:peminjaman.kembalikan')
        ->post(
            '/peminjaman/{peminjaman}/kembalikan',
            [PengembalianController::class, 'ajukan']
        )->name('pengembalian.ajukan');

    Route::middleware('permission:pengembalian.pantau')
        ->prefix('pengembalian')
        ->name('pengembalian.')
        ->group(function () {
            Route::get('/pantau', [PengembalianController::class, 'pantau'])->name('pantau');
            Route::get('/antrian', [PengembalianController::class, 'antrian'])->name('antrian');

            Route::get(
                '/{peminjaman}/verifikasi',
                [PengembalianController::class, 'formVerifikasi']
            )->name('verifikasi');

            Route::post(
                '/{peminjaman}/verifikasi',
                [PengembalianController::class, 'simpanVerifikasi']
            )->name('simpan');

            Route::get(
                '/rincian/{pengembalian}',
                [PengembalianController::class, 'rincian']
            )->name('rincian');
        });
        Route::middleware('permission:log.lihat')
        ->get('/log-aktivitas', [LogAktivitasController::class, 'index'])
        ->name('log.index');
        Route::middleware('permission:laporan.cetak')
        ->prefix('laporan')
        ->name('laporan.')
        ->group(function () {
            Route::get('/', [LaporanController::class, 'form'])->name('form');
            Route::get('/peminjaman', [LaporanController::class, 'peminjaman'])->name('peminjaman');
            Route::get('/pengembalian', [LaporanController::class, 'pengembalian'])->name('pengembalian');
            Route::get('/stok', [LaporanController::class, 'stok'])->name('stok');
        });
});