@extends('layouts.app')
@section('title', 'Akses Ditolak')
@section('content')
<div class="card auth-box" style="text-align:center">
    <h1 style="font-size:3rem;margin:0">403</h1>
    <h2>Akses Ditolak</h2>
    <p>Kamu tidak punya izin untuk membuka halaman ini.</p>
    <a href="{{ route('home') }}" class="btn">Kembali ke Beranda</a>
</div>
@endsection
