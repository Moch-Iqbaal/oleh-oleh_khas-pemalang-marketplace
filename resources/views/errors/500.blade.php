@extends('layouts.app')
@section('title', 'Terjadi Kesalahan')
@section('content')
<div class="card auth-box" style="text-align:center">
    <h1 style="font-size:3rem;margin:0">500</h1>
    <h2>Terjadi Kesalahan</h2>
    <p>Ada masalah di server. Coba lagi beberapa saat.</p>
    <a href="{{ route('home') }}" class="btn">Kembali ke Beranda</a>
</div>
@endsection
