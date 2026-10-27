@extends('layouts.app')
@section('title', 'Daftar')
@section('content')
@php
    $input = 'mt-1 w-full rounded-xl px-4 py-2.5 ring-1 ring-stone-200 focus:ring-2 focus:ring-orange-400';
    $type = old('account_type', request('jenis') === 'seller' ? 'seller' : 'customer');
@endphp
<div class="mx-auto max-w-lg px-4 py-12">
    <div class="rounded-3xl bg-white p-8 shadow-xl shadow-stone-200/60 ring-1 ring-stone-200/70">
        <h1 class="text-2xl font-extrabold tracking-tight">Buat akun</h1>
        <p class="mt-1 text-sm text-stone-500">Belanja oleh-oleh Pemalang, atau buka toko UMKM-mu sendiri.</p>
        <form action="{{ route('register') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-3">
                @foreach (['customer' => ['fa-bag-shopping', 'Pembeli'], 'seller' => ['fa-store', 'Penjual']] as $value => [$icon, $label])
                    <label class="cursor-pointer">
                        <input type="radio" name="account_type" value="{{ $value }}" class="peer sr-only" @checked($type === $value) onchange="document.getElementById('store-fields').classList.toggle('hidden', this.value !== 'seller')">
                        <span class="block rounded-2xl p-4 text-center ring-1 ring-stone-200 peer-checked:bg-orange-50 peer-checked:ring-2 peer-checked:ring-orange-500">
                            <span class="text-2xl"><i class="fa-solid {{ $icon }}" aria-hidden="true"></i></span>
                            <span class="mt-1 block text-sm font-semibold">{{ $label === 'Penjual' ? 'Daftar sebagai penjual' : 'Daftar sebagai pembeli' }}</span>
                        </span>
                    </label>
                @endforeach
            </div>
            @error('account_type') <p class="text-sm text-rose-600">{{ $message }}</p> @enderror

            <div>
                <label for="name" class="text-sm font-semibold">Nama lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="{{ $input }}">
                @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="email" class="text-sm font-semibold">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="{{ $input }}">
                @error('email') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label for="password" class="text-sm font-semibold">Password</label>
                    <input type="password" name="password" id="password" required class="{{ $input }}">
                    @error('password') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="text-sm font-semibold">Ulangi password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="{{ $input }}">
                </div>
            </div>

            {{-- Data toko, hanya diisi kalau daftar sebagai penjual --}}
            <div id="store-fields" class="space-y-4 rounded-2xl bg-stone-50 p-4 ring-1 ring-stone-200 {{ $type === 'seller' ? '' : 'hidden' }}">
                <p class="text-sm font-semibold text-stone-700">Data toko <span class="font-normal text-stone-500">(diverifikasi admin sebelum tampil)</span></p>
                <div>
                    <label for="store_name" class="text-sm font-semibold">Nama toko</label>
                    <input type="text" name="store_name" id="store_name" value="{{ old('store_name') }}" class="{{ $input }}">
                    @error('store_name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="store_phone" class="text-sm font-semibold">No. WhatsApp</label>
                    <input type="text" name="store_phone" id="store_phone" value="{{ old('store_phone') }}" placeholder="0812..." class="{{ $input }}">
                    @error('store_phone') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="store_address" class="text-sm font-semibold">Alamat toko</label>
                    <input type="text" name="store_address" id="store_address" value="{{ old('store_address') }}" placeholder="Kecamatan, Pemalang" class="{{ $input }}">
                    @error('store_address') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <button type="submit" class="w-full rounded-xl bg-orange-500 py-3 font-semibold text-white shadow-lg shadow-orange-500/30 hover:bg-orange-600">Daftar</button>
        </form>
        <p class="mt-6 text-center text-sm text-stone-500">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-orange-600">Masuk</a></p>
    </div>
</div>
@endsection
