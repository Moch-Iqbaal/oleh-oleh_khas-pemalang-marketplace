@extends('layouts.app')
@section('title', $product->name)
@section('content')
<div class="mx-auto max-w-6xl px-4 py-8">
    <nav class="text-sm text-stone-500">
        <a href="{{ route('home') }}" class="hover:text-orange-600">Beranda</a> /
        <a href="{{ route('home', ['kategori' => $product->category->slug]) }}" class="hover:text-orange-600">{{ $product->category->name }}</a> /
        <span class="text-stone-800">{{ $product->name }}</span>
    </nav>
    <div class="mt-6 grid gap-10 md:grid-cols-2">
        <div class="overflow-hidden rounded-3xl shadow-xl ring-1 ring-stone-200">
            <x-product-image :product="$product" class="h-80 md:h-[28rem]" />
        </div>
        <div>
            <a href="{{ route('shop.store', $product->store) }}" class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-sm font-semibold text-emerald-700 ring-1 ring-emerald-200 hover:bg-emerald-100">🏪 {{ $product->store->name }} ✔</a>
            <h1 class="mt-4 text-3xl font-extrabold tracking-tight md:text-4xl">{{ $product->name }}</h1>
            <p class="mt-4 text-3xl font-extrabold text-orange-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

            <dl class="mt-6 grid grid-cols-3 gap-3 text-center text-sm">
                <div class="rounded-2xl bg-white p-3 ring-1 ring-stone-200"><dt class="text-stone-500">Berat</dt><dd class="mt-1 font-bold">{{ $product->weight_grams }} g</dd></div>
                <div class="rounded-2xl bg-white p-3 ring-1 ring-stone-200"><dt class="text-stone-500">Tahan</dt><dd class="mt-1 font-bold">{{ $product->shelf_life_days ? $product->shelf_life_days.' hari' : 'Tidak basi' }}</dd></div>
                <div class="rounded-2xl bg-white p-3 ring-1 ring-stone-200"><dt class="text-stone-500">Stok</dt><dd class="mt-1 font-bold">{{ $product->stock }}</dd></div>
            </dl>

            @if ($product->shelf_life_days && $product->shelf_life_days <= 7)
                <p class="mt-4 rounded-2xl bg-amber-50 px-4 py-3 text-sm text-amber-800 ring-1 ring-amber-200">⏱️ Produk ini cepat basi. Cocok dibawa langsung, kurang cocok untuk kiriman jauh.</p>
            @endif

            <p class="mt-6 leading-relaxed text-stone-600">{{ $product->description }}</p>

            <div class="mt-8">
                @if ($product->stock > 0)
                    @auth
                        @if (auth()->user()->role === 'customer')
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex gap-3">
                                @csrf
                                <input type="number" name="qty" value="1" min="1" max="{{ $product->stock }}" class="w-24 rounded-xl px-4 py-3 ring-1 ring-stone-200 focus:ring-2 focus:ring-orange-400" aria-label="Jumlah">
                                <button class="flex-1 rounded-xl bg-orange-500 py-3 font-semibold text-white shadow-lg shadow-orange-500/30 hover:bg-orange-600">+ Masukkan keranjang</button>
                            </form>
                            @error('qty') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                        @else
                            <p class="text-sm text-stone-500">Login sebagai pembeli untuk membeli produk ini.</p>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block rounded-xl bg-orange-500 py-3 text-center font-semibold text-white hover:bg-orange-600">Masuk untuk membeli</a>
                    @endauth
                @else
                    <p class="rounded-xl bg-stone-100 py-3 text-center font-semibold text-stone-500">Stok habis</p>
                @endif
            </div>
        </div>
    </div>

    @if ($related->isNotEmpty())
        <h2 class="mt-16 text-2xl font-extrabold tracking-tight">Lainnya dari {{ $product->store->name }}</h2>
        <div class="mt-5 grid grid-cols-2 gap-4 md:grid-cols-4">
            @foreach ($related as $item)
                <x-product-card :product="$item" />
            @endforeach
        </div>
    @endif
</div>
@endsection
