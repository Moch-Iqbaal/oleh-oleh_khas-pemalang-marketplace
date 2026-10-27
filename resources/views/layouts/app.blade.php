<!DOCTYPE html>
<html lang="id">
<head>
    @include('layouts.head')
    <title>@yield('title', 'Beranda') · {{ config('app.name') }}</title>
</head>
<body class="flex min-h-screen flex-col bg-stone-50 font-sans text-stone-800 antialiased">
{{-- Navbar sticky --}}
<header class="sticky top-0 z-40 border-b border-stone-200/70 bg-white/80 backdrop-blur-lg">
    <div class="mx-auto flex max-w-6xl items-center gap-4 px-4 py-3">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ asset('images/brand/icon.svg') }}" alt="Logo {{ config('app.name') }}" class="h-9 w-9 rounded-xl">
            <span class="leading-tight">
                <span class="block font-extrabold tracking-tight">{{ config('app.name') }}</span>
                <span class="hidden text-xs text-stone-500 sm:block">Marketplace UMKM Pemalang</span>
            </span>
        </a>
        <form action="{{ route('home') }}" method="GET" class="ml-auto hidden flex-1 md:block md:max-w-sm">
            <input type="search" name="q" value="{{ \App\Support\Input::text(request('q')) }}" placeholder="Cari grontol, kopi, batik..."
                   class="w-full rounded-full border-0 bg-stone-100 px-4 py-2 text-sm ring-1 ring-stone-200 focus:bg-white focus:ring-2 focus:ring-orange-400">
        </form>
        <nav class="ml-auto flex items-center gap-2 text-sm font-medium md:ml-0">
            @auth
                @if (auth()->user()->role === 'customer')
                    <a href="{{ route('orders.index') }}" class="hidden rounded-full px-3 py-2 hover:bg-stone-100 sm:block">Pesanan</a>
                    <a href="{{ route('cart.index') }}" class="relative rounded-full p-2 hover:bg-stone-100" aria-label="Keranjang">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l2.4 11.2a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.5L21 7H6"/><circle cx="10" cy="20" r="1.3"/><circle cx="17" cy="20" r="1.3"/></svg>
                        @php $cartCount = array_sum(session('cart', [])); @endphp
                        @if ($cartCount > 0)
                            <span class="absolute -right-0.5 -top-0.5 grid h-5 min-w-5 place-items-center rounded-full bg-orange-500 px-1 text-[11px] font-bold text-white">{{ $cartCount }}</span>
                        @endif
                    </a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="rounded-full bg-stone-900 px-4 py-2 text-white hover:bg-stone-700">Panel</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="rounded-full px-3 py-2 text-stone-600 hover:bg-stone-100">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="rounded-full px-3 py-2 hover:bg-stone-100">Masuk</a>
                <a href="{{ route('register') }}" class="rounded-full bg-orange-500 px-4 py-2 text-white shadow-sm shadow-orange-500/30 hover:bg-orange-600">Daftar</a>
            @endauth
        </nav>
    </div>
</header>

<x-flash />

<main class="flex-1">
    @yield('content')
</main>

<footer class="mt-16 border-t border-stone-200 bg-white">
    <div class="mx-auto grid max-w-6xl gap-8 px-4 py-10 text-sm sm:grid-cols-3">
        <div>
            <p class="font-extrabold">{{ config('app.name') }}</p>
            <p class="mt-2 text-stone-500">Marketplace oleh-oleh dari UMKM Kabupaten Pemalang, untuk perantau, wisatawan, dan siapa saja yang mau kirim hadiah dari Pemalang.</p>
        </div>
        <div>
            <p class="font-semibold">Alamat</p>
            <p class="mt-2 text-stone-500">Jl. Contoh No. 1 (alamat placeholder)<br>Pemalang, Jawa Tengah</p>
        </div>
        <div>
            <p class="font-semibold">Punya usaha oleh-oleh?</p>
            <p class="mt-2 text-stone-500">Buka toko gratis dan jangkau pembeli dari luar kota.</p>
            <a href="{{ route('register', ['jenis' => 'seller']) }}" class="mt-3 inline-block font-semibold text-orange-600 hover:underline">Daftar sebagai penjual <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
    </div>
    <p class="border-t border-stone-100 py-4 text-center text-xs text-stone-400">© {{ date('Y') }} {{ config('app.name') }}</p>
</footer>
</body>
</html>
