@extends('layouts.app')
@section('title', 'Oleh-oleh khas Pemalang')
@section('content')
@if (! $search && ! $categorySlug)
{{-- Hero --}}
<section class="relative overflow-hidden bg-gradient-to-br from-orange-50 via-amber-50 to-rose-50">
    <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-orange-200/40 blur-3xl"></div>
    <div class="absolute -bottom-32 left-10 h-80 w-80 rounded-full bg-rose-200/40 blur-3xl"></div>
    <div class="relative mx-auto grid max-w-6xl items-center gap-10 px-4 py-16 md:grid-cols-2 md:py-24">
        <div>
            <span class="inline-flex items-center gap-2 rounded-full bg-white/80 px-3 py-1 text-xs font-semibold text-orange-700 ring-1 ring-orange-200">📍 Langsung dari UMKM Pemalang</span>
            <h1 class="mt-5 text-4xl font-extrabold leading-tight tracking-tight text-stone-900 md:text-5xl">
                Bawa pulang rasa <span class="bg-gradient-to-r from-orange-500 to-rose-600 bg-clip-text text-transparent">Pemalang</span>, ke mana pun kamu pergi.
            </h1>
            <p class="mt-5 max-w-lg text-lg text-stone-600">Oleh-oleh untuk perantau dan wisatawan, juga kiriman hadiah dari Pemalang untuk keluarga di luar kota. Semua dari penjual lokal.</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#produk" class="rounded-full bg-orange-500 px-6 py-3 font-semibold text-white shadow-lg shadow-orange-500/30 transition hover:-translate-y-0.5 hover:bg-orange-600">Belanja sekarang</a>
                <a href="{{ route('register', ['jenis' => 'seller']) }}" class="rounded-full bg-white px-6 py-3 font-semibold text-stone-800 ring-1 ring-stone-200 transition hover:ring-orange-400">Buka toko UMKM</a>
            </div>
            <dl class="mt-10 flex gap-8 text-sm">
                <div><dt class="text-stone-500">Toko terverifikasi</dt><dd class="text-2xl font-extrabold">{{ $stores->count() }}</dd></div>
                <div><dt class="text-stone-500">Produk</dt><dd class="text-2xl font-extrabold">{{ $products->total() }}</dd></div>
            </dl>
        </div>
        <div class="hidden grid-cols-2 gap-4 md:grid">
            @foreach ($featured->take(4) as $i => $item)
                <a href="{{ route('shop.show', $item) }}" class="overflow-hidden rounded-3xl shadow-xl ring-4 ring-white transition hover:-translate-y-1 {{ $i % 2 ? 'translate-y-8' : '' }}">
                    <x-product-image :product="$item" class="h-40" />
                    <p class="bg-white px-4 py-2 text-sm font-semibold">{{ $item->name }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<div id="produk" class="mx-auto max-w-6xl px-4 pt-10">
    {{-- Chip kategori --}}
    <div class="flex gap-2 overflow-x-auto pb-2">
        <a href="{{ route('home') }}#produk" class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition {{ ! $categorySlug ? 'bg-stone-900 text-white' : 'bg-white ring-1 ring-stone-200 hover:ring-orange-400' }}">Semua</a>
        @foreach ($categories as $category)
            <a href="{{ route('home', ['kategori' => $category->slug]) }}#produk"
               class="shrink-0 rounded-full px-4 py-2 text-sm font-semibold transition {{ $categorySlug === $category->slug ? 'bg-stone-900 text-white' : 'bg-white ring-1 ring-stone-200 hover:ring-orange-400' }}">
                {{ $category->name }} <span class="opacity-60">{{ $category->products_count }}</span>
            </a>
        @endforeach
    </div>

    {{-- Pencarian untuk layar kecil --}}
    <form action="{{ route('home') }}" method="GET" class="mt-4 md:hidden">
        <input type="search" name="q" value="{{ $search }}" placeholder="Cari oleh-oleh..." class="w-full rounded-full px-4 py-2.5 ring-1 ring-stone-200 focus:ring-2 focus:ring-orange-400">
    </form>

    @if ($featured->isNotEmpty())
        <h2 class="mt-10 text-2xl font-extrabold tracking-tight">⭐ Produk unggulan</h2>
        <div class="mt-5 grid grid-cols-2 gap-4 md:grid-cols-4">
            @foreach ($featured as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    @endif

    <div class="mt-12 flex items-end justify-between">
        <h2 class="text-2xl font-extrabold tracking-tight">
            @if ($search) Hasil untuk “{{ $search }}” @elseif ($categorySlug) {{ $categories->firstWhere('slug', $categorySlug)?->name }} @else Semua oleh-oleh @endif
        </h2>
        <p class="text-sm text-stone-500">{{ $products->total() }} produk</p>
    </div>
    <div class="mt-5 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
        @forelse ($products as $product)
            <x-product-card :product="$product" />
        @empty
            <div class="col-span-full rounded-2xl bg-white p-10 text-center text-stone-500 ring-1 ring-stone-200">Produk tidak ditemukan. Coba kata kunci lain.</div>
        @endforelse
    </div>
    {{ $products->links('pagination') }}

    @if (! $search && ! $categorySlug)
        <h2 class="mt-16 text-2xl font-extrabold tracking-tight">Kenalan sama penjualnya</h2>
        <div class="mt-5 grid gap-4 sm:grid-cols-3">
            @foreach ($stores as $store)
                <a href="{{ route('shop.store', $store) }}" class="group rounded-2xl bg-white p-5 shadow-sm ring-1 ring-stone-200/70 transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-center gap-3">
                        <span class="grid h-12 w-12 place-items-center rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 text-lg font-extrabold text-white">{{ mb_substr($store->name, 0, 1) }}</span>
                        <div>
                            <p class="font-semibold group-hover:text-orange-600">{{ $store->name }} <span class="text-emerald-600" title="Terverifikasi">✔</span></p>
                            <p class="text-xs text-stone-500">{{ $store->address }}</p>
                        </div>
                    </div>
                    <p class="mt-3 line-clamp-2 text-sm text-stone-600">{{ $store->description }}</p>
                    <p class="mt-3 text-xs font-semibold text-stone-500">{{ $store->products_count }} produk</p>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
