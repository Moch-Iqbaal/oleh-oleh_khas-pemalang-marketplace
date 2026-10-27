@extends('layouts.app')
@section('title', 'Keranjang')
@section('content')
<div class="mx-auto max-w-6xl px-4 py-10">
    <h1 class="text-3xl font-extrabold tracking-tight">Keranjang</h1>
    @if ($products->isEmpty())
        <div class="mt-8 rounded-3xl bg-white p-12 text-center ring-1 ring-stone-200">
            <p class="text-5xl text-stone-300"><i class="fa-solid fa-basket-shopping" aria-hidden="true"></i></p>
            <p class="mt-4 text-stone-500">Keranjang masih kosong.</p>
            <a href="{{ route('home') }}" class="mt-6 inline-block rounded-full bg-orange-500 px-6 py-3 font-semibold text-white hover:bg-orange-600">Cari oleh-oleh</a>
        </div>
    @else
        <div class="mt-8 grid gap-8 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                @foreach ($groups as $items)
                    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-stone-200">
                        <p class="border-b border-stone-100 bg-stone-50 px-5 py-3 text-sm font-semibold"><i class="fa-solid fa-store text-stone-400" aria-hidden="true"></i> {{ $items->first()->store->name }}</p>
                        @foreach ($items as $product)
                            <div class="flex flex-wrap items-center gap-4 border-b border-stone-100 p-5 last:border-0">
                                <x-product-image :product="$product" class="h-16 !w-16 rounded-xl" />
                                <div class="min-w-40 flex-1">
                                    <a href="{{ route('shop.show', $product) }}" class="font-semibold hover:text-orange-600">{{ $product->name }}</a>
                                    <p class="text-sm text-stone-500">Rp {{ number_format($product->price, 0, ',', '.') }} · {{ $product->weight_grams }} g</p>
                                </div>
                                <form action="{{ route('cart.update', $product) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="qty" value="{{ $cart[$product->id] }}" min="1" max="{{ $product->stock }}" class="w-20 rounded-xl px-3 py-2 ring-1 ring-stone-200" aria-label="Jumlah">
                                    <button class="rounded-xl px-3 py-2 text-sm font-semibold ring-1 ring-stone-200 hover:ring-orange-400">Ubah</button>
                                </form>
                                <p class="w-28 text-right font-bold">Rp {{ number_format($product->price * $cart[$product->id], 0, ',', '.') }}</p>
                                <form action="{{ route('cart.remove', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-full p-2 text-stone-400 hover:bg-rose-50 hover:text-rose-600" aria-label="Hapus"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <aside class="h-fit rounded-3xl bg-white p-6 shadow-sm ring-1 ring-stone-200 lg:sticky lg:top-24">
                <h2 class="text-lg font-bold">Ringkasan</h2>
                <dl class="mt-4 space-y-2 text-sm">
                    <div class="flex justify-between"><dt class="text-stone-500">Jumlah barang</dt><dd>{{ array_sum($cart) }}</dd></div>
                    <div class="flex justify-between"><dt class="text-stone-500">Jumlah toko</dt><dd>{{ $groups->count() }}</dd></div>
                    <div class="flex justify-between border-t border-stone-100 pt-3 text-base font-extrabold"><dt>Total</dt><dd>Rp {{ number_format($total, 0, ',', '.') }}</dd></div>
                </dl>
                @if ($groups->count() > 1)
                    <p class="mt-4 rounded-xl bg-sky-50 px-3 py-2 text-xs text-sky-800">Pesanan akan dipecah jadi {{ $groups->count() }} invoice, satu per toko.</p>
                @endif
                <form action="{{ route('checkout') }}" method="POST" class="mt-6">
                    @csrf
                    <button class="w-full rounded-xl bg-orange-500 py-3 font-semibold text-white shadow-lg shadow-orange-500/30 hover:bg-orange-600">Checkout sekarang</button>
                </form>
            </aside>
        </div>
    @endif
</div>
@endsection
