@extends('layouts.app')
@section('title', 'Halaman Tidak Ditemukan')
@section('content')
<div class="card auth-box" style="text-align:center">
    <h1 style="font-size:3rem;margin:0">404</h1>
    <h2>Halaman Tidak Ditemukan</h2>
    <p>Halaman atau data yang kamu cari tidak ada.</p>
    <a href="{{ route('home') }}" class="btn">Kembali ke Beranda</a>
</div>
@endsection
