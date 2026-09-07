<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Listeners\CatatLogout;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Peminjaman;
use App\Observers\LogObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        
        Event::listen(Logout::class, CatatLogout::class);
        Kategori::observe(LogObserver::class);
        Alat::observe(LogObserver::class);
        User::observe(LogObserver::class);

        // Share data count untuk badge navbar petugas
        View::composer('*', function ($view) {
            // 1. Persetujuan: Menghitung yang statusnya 'diajukan'
            $countPersetujuan = Peminjaman::where('status', 'diajukan')->count();

            // 2. Pemantauan: Menghitung barang yang sedang 'dipinjam'
            $countPemantauan  = Peminjaman::where('status', 'dipinjam')->count();

            // 3. Verifikasi: Ganti 'menunggu_verifikasi' sesuai teks enum asli di phpMyAdmin kamu
            $countVerifikasi  = Peminjaman::where('status', 'menunggu_verifikasi')->count();

            $view->with([
                'countPersetujuan' => $countPersetujuan,
                'countPemantauan'  => $countPemantauan,
                'countVerifikasi'  => $countVerifikasi,
            ]);
        });
    }
}