@extends('layouts.utama')

@section('judul', 'Dasbor Admin')

@section('konten')
<h4>Dasbor Admin</h4>
<p class="text-muted">Selamat datang, {{ auth()->user()->nama ?? auth()->user()->name }}.</p>
@endsection