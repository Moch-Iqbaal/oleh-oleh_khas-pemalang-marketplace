@extends('layouts.app')
@section('title', 'Masuk')
@section('content')
<div class="mx-auto max-w-md px-4 py-12">
    <div class="rounded-3xl bg-white p-8 shadow-xl shadow-stone-200/60 ring-1 ring-stone-200/70">
        <h1 class="text-2xl font-extrabold tracking-tight">Selamat datang lagi</h1>
        <p class="mt-1 text-sm text-stone-500">Masuk untuk lanjut belanja atau kelola tokomu.</p>
        <form action="{{ route('login') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="email" class="text-sm font-semibold">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="mt-1 w-full rounded-xl border-stone-300 px-4 py-2.5 ring-1 ring-stone-200 focus:ring-2 focus:ring-orange-400">
                @error('email') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="password" class="text-sm font-semibold">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 w-full rounded-xl px-4 py-2.5 ring-1 ring-stone-200 focus:ring-2 focus:ring-orange-400">
                @error('password') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <label class="flex items-center gap-2 text-sm text-stone-600"><input type="checkbox" name="remember" class="rounded"> Ingat saya</label>
            <button type="submit" class="w-full rounded-xl bg-orange-500 py-3 font-semibold text-white shadow-lg shadow-orange-500/30 hover:bg-orange-600">Masuk</button>
        </form>
        <p class="mt-6 text-center text-sm text-stone-500">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-orange-600">Daftar</a></p>
    </div>
</div>
@endsection
