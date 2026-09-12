@extends('layouts.utama')

@section('judul', 'Dasbor Petugas')

@section('konten')
<!-- Banner / Kotak Welcoming Selamat Datang Petugas -->
<div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%); color: #ffffff;">
    <div class="card-body p-4 d-flex align-items-center justify-content-between">
        <div>
            <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm" style="font-size: 0.8rem;">
                <i class="bi bi-person-badge-fill me-1"></i> Petugas Dashboard
            </span>
            <h3 class="fw-bold mb-1 text-white">Selamat Datang, {{ auth()->user()->nama ?? auth()->user()->name ?? 'Petugas' }}</h3>
            <p class="mb-0 text-white-50">Kelola persetujuan, pemantauan alat, verifikasi pengembalian, dan laporan transaksi.</p>
        </div>
        <div class="d-none d-md-block text-end opacity-75">
            <i class="bi bi-headset fs-1" style="font-size: 3.5rem !important;"></i>
        </div>
    </div>
</div>

<!-- Grid Kartu Statistik Tugas Petugas -->
<div class="row g-3 mb-4">
    <!-- 1. Persetujuan -->
    <div class="col-md-3">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--amber) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(59,130,246,.12); color: var(--amber);">
                    <i class="bi bi-file-earmark-check-fill"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Butuh Persetujuan</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $persetujuanCount ?? $totalPersetujuan ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Pemantauan (Disetujui / Sedang Dipinjam) -->
    <div class="col-md-3">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--navy) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(37,99,235,.12); color: var(--navy);">
                    <i class="bi bi-eye-fill"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Pemantauan Alat</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $pemantauanCount ?? $totalPemantauan ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Verifikasi -->
    <div class="col-md-3">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--success) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(34,197,94,.12); color: var(--success);">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Verifikasi Pengembalian</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $verifikasiCount ?? $totalVerifikasi ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Laporan -->
    <div class="col-md-3">
        <div class="card stat-card border-0 shadow-sm rounded-4 h-100" style="border-left: 5px solid var(--danger) !important;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: rgba(239,68,68,.12); color: var(--danger);">
                    <i class="bi bi-bar-chart-line-fill"></i>
                </div>
                <div>
                    <div class="text-muted small mb-1 fw-semibold">Total Laporan</div>
                    <div class="fs-2 fw-bold" style="color: var(--navy); font-family: 'Space Grotesk', sans-serif;">
                        {{ $laporanCount ?? $totalLaporan ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection