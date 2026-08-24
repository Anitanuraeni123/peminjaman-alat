@extends('layouts.utama')

@section('judul', 'Antrian Pengajuan')

@section('konten')
    <h4 class="mb-3">Antrian Pengajuan</h4>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                @include('persetujuan.tabel-antrian')
            </div>

            <div class="mt-3">
                {{ $daftarPengajuan->links() }}
            </div>
        </div>
    </div>
@endsection