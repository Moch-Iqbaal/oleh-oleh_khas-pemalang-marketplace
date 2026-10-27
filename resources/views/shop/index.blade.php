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
            <span class="inline-flex items-center gap-2 rounded-full bg-white/80 px-3 py-1 text-xs font-semibold text-orange-700 ring-1 ring-orange-200"><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Langsung dari UMKM Pemalang</span>
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

@if ($highlight)
{{-- Sorotan: Nasi Grombyang --}}
<section class="mx-auto max-w-6xl px-4 pt-12">
    <div class="grid overflow-hidden rounded-3xl bg-stone-900 text-white shadow-xl md:grid-cols-2">
        <img src="{{ asset('images/highlight/nasi-grombyang.webp') }}" alt="Semangkuk nasi grombyang" class="h-64 w-full object-cover md:h-full" loading="lazy">
        <div class="p-8 md:p-10">
            <span class="rounded-full bg-orange-500/20 px-3 py-1 text-xs font-semibold text-orange-300 ring-1 ring-orange-400/40">Khas Pemalang</span>
            <h2 class="mt-4 text-3xl font-extrabold tracking-tight">Nasi Grombyang</h2>
            <p class="mt-3 leading-relaxed text-stone-300">Ikon kuliner Pemalang sejak sekitar 1960-an: nasi dan potongan daging (dulu kerbau, kini umumnya sapi) dalam kuah berbumbu kluwek dan rempah yang melimpah. Nama <em>grombyang</em> berarti “bergoyang”, karena nasinya seolah mengapung di kuah.</p>
            <p class="mt-4 text-sm text-stone-400">Sekarang bisa dibawa pulang dalam paket siap saji dari {{ $highlight->store->name }}.</p>
            <div class="mt-6 flex flex-wrap items-center gap-4">
                <a href="{{ route('shop.show', $highlight) }}" class="rounded-full bg-orange-500 px-6 py-3 font-semibold text-white shadow-lg shadow-orange-500/30 hover:bg-orange-600">Lihat paket grombyang</a>
                <span class="text-xl font-extrabold">Rp {{ number_format($highlight->price, 0, ',', '.') }}</span>
            </div>
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
        <h2 class="mt-10 text-2xl font-extrabold tracking-tight"><i class="fa-solid fa-star text-amber-500" aria-hidden="true"></i> Produk unggulan</h2>
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
                        <x-store-avatar :store="$store" class="h-14 w-14 rounded-2xl text-lg" />
                        <div>
                            <p class="font-semibold group-hover:text-orange-600">{{ $store->name }} <span class="text-emerald-600" title="Terverifikasi"><i class="fa-solid fa-circle-check" aria-hidden="true"></i><span class="sr-only">Terverifikasi</span></span></p>
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
