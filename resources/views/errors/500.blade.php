@extends('layouts.app')
@section('title', 'Terjadi kesalahan')
@section('content')
<div class="mx-auto max-w-md px-4 py-24 text-center">
    <p class="bg-gradient-to-br from-orange-500 to-rose-600 bg-clip-text text-7xl font-extrabold text-transparent">500</p>
    <h1 class="mt-4 text-2xl font-extrabold">Terjadi kesalahan</h1>
    <p class="mt-2 text-stone-500">Ada masalah di server. Coba lagi beberapa saat.</p>
    <a href="{{ route('home') }}" class="mt-8 inline-block rounded-full bg-orange-500 px-6 py-3 font-semibold text-white hover:bg-orange-600">Kembali ke beranda</a>
</div>
@endsection
