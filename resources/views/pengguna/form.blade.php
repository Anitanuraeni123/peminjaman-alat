@extends('layouts.utama')

@section('judul', $pengguna->exists ? 'Ubah Pengguna' : 'Tambah Pengguna')

@section('konten')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <!-- Header Judul & Catatan Wajib Diisi -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title fw-bold m-0">
                        {{ $pengguna->exists ? 'Ubah Data Pengguna' : 'Tambah Data Pengguna' }}
                    </h5>
                    <span class="text-muted small"><span class="text-danger fw-bold">*</span> Wajib diisi</span>
                </div>

                <form method="POST" action="{{ $pengguna->exists ? route('pengguna.update', $pengguna) : route('pengguna.store') }}">
                    @csrf
                    @if ($pengguna->exists)
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <!-- Nama Lengkap -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $pengguna->nama) }}" required placeholder="">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Pengguna / Username -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Pengguna <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $pengguna->username) }}" required placeholder="">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $pengguna->email) }}" required placeholder="">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp', $pengguna->no_telp) }}" required placeholder="">
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kata Sandi -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kata Sandi <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Kata Sandi -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" required placeholder="">
                        </div>

                        <!-- Peran -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Peran <span class="text-danger">*</span></label>
                            <select class="form-select @error('peran') is-invalid @enderror" id="peran" name="peran" required>
                                <option value="" disabled selected>-- Pilih Peran --</option>
                                @foreach ($daftarPeran as $pilihanPeran)
                                    <option value="{{ $pilihanPeran->name }}"
                                        {{ old('peran', $pengguna->roles->first()?->name) == $pilihanPeran->name ? 'selected' : '' }}>
                                        {{ ucfirst($pilihanPeran->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('peran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Aktif -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Aktif <span class="text-danger">*</span></label>
                            <select name="is_aktif" class="form-select @error('is_aktif') is-invalid @enderror" required>
                                <option value="" disabled selected>Pilih status aktif</option>
                                <option value="1" {{ old('is_aktif', $pengguna->is_aktif) == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_aktif', $pengguna->is_aktif) === '0' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('is_aktif')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary px-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection