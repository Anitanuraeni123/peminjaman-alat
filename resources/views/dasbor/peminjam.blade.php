@extends('layouts.utama')

@section('judul', 'Dasbor Peminjam')

@section('konten')
<h4>Dasbor Peminjam</h4>
<p class="text-muted">Selamat datang, {{ auth()->user()->nama ?? auth()->user()->name }}.</p>
@endsection