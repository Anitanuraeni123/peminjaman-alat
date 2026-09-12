@extends('layouts.utama')

@section('judul', 'Dasbor Admin')

@section('konten')
<!-- Banner / Kotak Welcoming Selamat Datang -->
<div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%); color: #ffffff;">
    <div class="card-body p-4 d-flex align-items-center justify-content-between">
        <div>
            <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm" style="font-size: 0.8rem;">
                <i class="bi bi-shield-check me-1"></i> Admin Dashboard
            </span>
            <h3 class="fw-bold mb-1 text-white">Selamat Datang, {{ auth()->user()->nama ?? auth()->user()->name ?? 'Administrator' }}</h3>
            <p class="mb-0 text-white-50">Kelola data peminjaman, alat, pengguna, dan kategori dalam satu tempat secara efisien.</p>
        </div>
        <div class="d-none d-md-block text-end opacity-75">
            <i class="bi bi-person-badge fs-1" style="font-size: 3.5rem !important;"></i>
        </div>
    </div>
</div>

<!-- Grid Kartu Statistik: Baris 1 (3 kartu) -->
<div class="row g-3 mb-3">
    <!-- Total Kategori -->
    <div class="col-md-4">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--navy) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(37,99,235,.12); color: var(--navy);">
                    <i class="bi bi-tags-fill"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Total Kategori</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $totalKategori ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Alat -->
    <div class="col-md-4">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--amber) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(59,130,246,.12); color: var(--amber);">
                    <i class="bi bi-tools"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Total Alat</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $totalStok ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pengguna -->
    <div class="col-md-4">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--success) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(34,197,94,.12); color: var(--success);">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Total Pengguna</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $totalPengguna ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grid Kartu Statistik: Baris 2 (3 kartu) -->
<div class="row g-3 mb-4">
    <!-- Total Peminjaman -->
    <div class="col-md-4">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--danger) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(239,68,68,.12); color: var(--danger);">
                    <i class="bi bi-journal-text"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Total Peminjaman</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $totalPeminjaman ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pengembalian -->
    <div class="col-md-4">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--amber) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(59,130,246,.12); color: var(--amber);">
                    <i class="bi bi-arrow-return-left"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Total Pengembalian</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $totalPengembalian ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aktivitas Hari Ini -->
    <div class="col-md-4">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--navy) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(37,99,235,.12); color: var(--navy);">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Aktivitas Hari Ini</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $aktivitasHariIni ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Panel Daftar Aktivitas Hari Ini -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h6 class="fw-bold mb-0" style="color: var(--navy);">
                <i class="bi bi-clock-history me-1"></i> Aktivitas Terbaru Hari Ini
            </h6>
            <a href="{{ route('log.index') }}" class="small text-decoration-none">Lihat semua &rarr;</a>
        </div>

        <div class="d-flex flex-wrap align-items-start gap-4">
            @forelse ($daftarAktivitasHariIni ?? [] as $log)
                <div style="min-width: 160px; max-width: 200px;">
                    <div class="fw-semibold small mb-1">{{ $log->pengguna->nama ?? 'Tidak dikenal' }}</div>
                    <div class="mb-1">
                        <span class="badge bg-secondary">{{ str_replace('_', ' ', $log->aksi) }}</span>
                    </div>
                    <div class="text-muted small mb-1">{{ $log->deskripsi }}</div>
                    <div class="text-muted small">{{ $log->created_at->format('H:i') }}</div>
                </div>
            @empty
                <p class="text-muted small mb-0">Belum ada aktivitas hari ini.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection