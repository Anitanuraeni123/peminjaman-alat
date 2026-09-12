@extends('layouts.utama')

@section('judul', 'Dasbor Peminjam')

@section('konten')
<!-- Banner / Kotak Welcoming Selamat Datang Peminjam -->
<div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%); color: #ffffff;">
    <div class="card-body p-4 d-flex align-items-center justify-content-between">
        <div>
            <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm" style="font-size: 0.8rem;">
                <i class="bi bi-person-fill me-1"></i> Peminjam Dashboard
            </span>
            <h3 class="fw-bold mb-1 text-white">Selamat Datang, {{ auth()->user()->nama ?? auth()->user()->name ?? 'Peminjam' }}</h3>
            <p class="mb-0 text-white-50">Cari alat yang kamu butuhkan, ajukan peminjaman, dan pantau status pinjamanmu di sini.</p>
        </div>
        <div class="d-none d-md-block text-end opacity-75">
            <i class="bi bi-backpack fs-1" style="font-size: 3.5rem !important;"></i>
        </div>
    </div>
</div>

<!-- Grid Kartu Statistik Peminjam -->
<div class="row g-3 mb-4">
    <!-- Katalog Alat -->
    <div class="col-md-3">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--navy) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(37,99,235,.12); color: var(--navy);">
                    <i class="bi bi-grid-fill"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Tersedia di Katalog</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $totalKatalog ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Keranjang Saya -->
    <div class="col-md-3">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--amber) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(59,130,246,.12); color: var(--amber);">
                    <i class="bi bi-cart-fill"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Item di Keranjang</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $totalKeranjang ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Peminjaman Aktif -->
    <div class="col-md-3">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--success) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(34,197,94,.12); color: var(--success);">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Pinjaman Aktif</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $peminjamanAktif ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Riwayat Peminjaman -->
    <div class="col-md-3">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--danger) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(239,68,68,.12); color: var(--danger);">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Total Peminjaman Saya</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $totalPeminjamanSaya ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection