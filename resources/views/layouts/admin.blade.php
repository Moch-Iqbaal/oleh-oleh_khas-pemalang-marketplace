<!DOCTYPE html>
<html lang="id">
<head>
    @include('layouts.head')
    <title>@yield('title', 'Panel') · Panel {{ config('app.name') }}</title>
</head>
@php
    $user = auth()->user();
    $menu = [['admin.dashboard', 'Dashboard', 'fa-chart-line', true]];
    $menu[] = ['admin.products.index', $user->isSeller() ? 'Produk Saya' : 'Produk', 'fa-box', true];
    $menu[] = ['admin.orders.index', 'Pesanan', 'fa-receipt', true];
    $menu[] = ['admin.my-store.edit', 'Profil Toko', 'fa-store', $user->isSeller()];
    $menu[] = ['admin.categories.index', 'Kategori', 'fa-tags', $user->isPlatformStaff()];
    $menu[] = ['admin.stores.index', 'Verifikasi Toko', 'fa-circle-check', $user->isAdmin()];
    $menu[] = ['admin.users.index', 'User', 'fa-users', $user->isAdmin()];
@endphp
<body class="min-h-screen bg-stone-100 font-sans text-stone-800 antialiased">
<div class="flex min-h-screen">
    {{-- Sidebar (di layar kecil jadi bar atas) --}}
    <aside class="fixed inset-y-0 left-0 z-30 hidden w-64 flex-col bg-stone-900 text-stone-300 lg:flex">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-6 py-6">
            <img src="{{ asset('images/brand/icon.svg') }}" alt="Logo {{ config('app.name') }}" class="h-9 w-9 rounded-xl">
            <span class="leading-tight"><span class="block font-extrabold text-white">{{ config('app.name') }}</span><span class="text-xs capitalize text-stone-400">Panel {{ $user->role }}</span></span>
        </a>
        <nav class="flex-1 space-y-1 px-3">
            @foreach ($menu as [$route, $label, $icon, $show])
                @if ($show)
                    @php $active = request()->routeIs(str_replace('.index', '.*', str_replace('.edit', '.*', $route))); @endphp
                    <a href="{{ route($route) }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ $active ? 'bg-white/10 text-white' : 'hover:bg-white/5 hover:text-white' }}">
                        <i class="fa-solid {{ $icon }} w-5 text-center" aria-hidden="true"></i> {{ $label }}
                    </a>
                @endif
            @endforeach
        </nav>
        <div class="border-t border-white/10 p-4 text-sm">
            <a href="{{ route('home') }}" class="block rounded-xl px-3 py-2 hover:bg-white/5"><i class="fa-solid fa-bag-shopping w-5 text-center" aria-hidden="true"></i> Lihat etalase</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full rounded-xl px-3 py-2 text-left hover:bg-white/5"><i class="fa-solid fa-right-from-bracket w-5 text-center" aria-hidden="true"></i> Keluar ({{ $user->name }})</button>
            </form>
        </div>
    </aside>
    <div class="flex-1 lg:pl-64">
        <header class="sticky top-0 z-20 flex items-center gap-3 overflow-x-auto border-b border-stone-200 bg-white/80 px-4 py-3 backdrop-blur lg:hidden">
            @foreach ($menu as [$route, $label, $icon, $show])
                @if ($show)
                    <a href="{{ route($route) }}" class="shrink-0 rounded-full px-3 py-1.5 text-sm font-medium ring-1 ring-stone-200"><i class="fa-solid {{ $icon }}" aria-hidden="true"></i> {{ $label }}</a>
                @endif
            @endforeach
        </header>
        <x-flash />
        <main class="mx-auto max-w-6xl p-4 md:p-8">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
