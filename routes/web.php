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
use App\Http\Controllers\KoreksiPeminjamanController;
use App\Http\Controllers\KoreksiPengembalianController;
use App\Http\Controllers\PengaturanController;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\LogAktivitas;
use App\Enums\StatusPeminjaman;

// Redirect halaman utama langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Group route yang membutuhkan autentikasi (harus login terlebih dahulu)
Route::middleware(['auth'])->group(function () {

    // Dasbor Admin
    Route::get('/admin/dasbor', function () {
        $totalKategori = Kategori::count();
        $totalStok = Alat::sum('stok');
        $totalPengguna = User::count();
        $totalPeminjaman = Peminjaman::count();
        $totalPengembalian = Pengembalian::count();

        $daftarAktivitasHariIni = LogAktivitas::with('pengguna')
            ->whereDate('created_at', today())
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        $aktivitasHariIni = $daftarAktivitasHariIni->count();

        return view('dasbor.admin', compact(
            'totalKategori',
            'totalStok',
            'totalPengguna',
            'totalPeminjaman',
            'totalPengembalian',
            'aktivitasHariIni',
            'daftarAktivitasHariIni'
        ));
    })->middleware('role:admin')->name('admin.dasbor');

    // Dasbor Petugas (Sudah Disesuaikan)
    Route::get('/petugas/dasbor', function () {
        $persetujuanCount = Peminjaman::where('status', StatusPeminjaman::Diajukan)->count();
        $pemantauanCount  = Peminjaman::where('status', StatusPeminjaman::Dipinjam)->count();
        $verifikasiCount  = Peminjaman::where('status', StatusPeminjaman::MenungguVerifikasi)->count();
        $laporanCount     = Peminjaman::count();

        return view('dasbor.petugas', compact('persetujuanCount', 'pemantauanCount', 'verifikasiCount', 'laporanCount'));
    })->middleware('role:petugas')->name('petugas.dasbor');

    // Dasbor Peminjam
    Route::get('/peminjam/dasbor', function () {
        $user = auth()->user();

        // Hitung data spesifik untuk peminjam yang sedang login
        $totalKatalog  = Alat::count();
        $totalKeranjang = session()->get('keranjang') ? count(session()->get('keranjang')) : 0;
        $peminjamanAktif = Peminjaman::where('user_id', $user->id)
            ->where('status', StatusPeminjaman::Dipinjam)
            ->count();
        $totalPeminjamanSaya = Peminjaman::where('user_id', $user->id)->count();

        return view('dasbor.peminjam', compact(
            'totalKatalog',
            'totalKeranjang',
            'peminjamanAktif',
            'totalPeminjamanSaya'
        ));
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

    Route::middleware('permission:peminjaman.kelola')
        ->prefix('koreksi/peminjaman')
        ->name('koreksi.peminjaman.')
        ->group(function () {
            Route::get('/', [KoreksiPeminjamanController::class, 'daftar'])->name('daftar');
            Route::get('/{peminjaman}/ubah', [KoreksiPeminjamanController::class, 'formUbah'])->name('ubah');
            Route::put('/{peminjaman}', [KoreksiPeminjamanController::class, 'perbarui'])->name('perbarui');
            Route::delete('/{peminjaman}', [KoreksiPeminjamanController::class, 'hapus'])->name('hapus');
        });

    Route::middleware('permission:pengembalian.kelola')
        ->prefix('koreksi/pengembalian')
        ->name('koreksi.pengembalian.')
        ->group(function () {
            Route::get('/', [KoreksiPengembalianController::class, 'daftar'])->name('daftar');
            Route::get('/{pengembalian}/ubah', [KoreksiPengembalianController::class, 'formUbah'])->name('ubah');
            Route::put('/{pengembalian}', [KoreksiPengembalianController::class, 'perbarui'])->name('perbarui');
        });

    Route::middleware('permission:pengaturan.kelola')
        ->prefix('pengaturan')
        ->name('pengaturan.')
        ->group(function () {
            Route::get('/', [PengaturanController::class, 'form'])->name('form');
            Route::put('/', [PengaturanController::class, 'perbarui'])->name('perbarui');
        });
});