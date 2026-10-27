@extends('layouts.app')
@section('title', $store->name)
@section('content')
<section class="bg-gradient-to-br from-emerald-50 to-teal-50">
    <div class="mx-auto flex max-w-6xl flex-col gap-6 px-4 py-12 sm:flex-row sm:items-center">
        <x-store-avatar :store="$store" class="h-28 w-28 rounded-3xl text-3xl shadow-lg ring-4 ring-white" />
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight">{{ $store->name }} <span class="text-emerald-600" title="Terverifikasi"><i class="fa-solid fa-circle-check" aria-hidden="true"></i><span class="sr-only">Terverifikasi</span></span></h1>
            <p class="mt-1 text-stone-600">{{ $store->description }}</p>
            <p class="mt-2 text-sm text-stone-500"><i class="fa-solid fa-location-dot" aria-hidden="true"></i> {{ $store->address }} · <i class="fa-solid fa-phone" aria-hidden="true"></i> {{ $store->phone }}</p>
        </div>
    </div>
</section>
<div class="mx-auto max-w-6xl px-4 pt-8">
    <x-store-location :store="$store" />
</div>
<div class="mx-auto max-w-6xl px-4 py-10">
    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
        @forelse ($products as $product)
            <x-product-card :product="$product->setRelation('store', $store)" />
        @empty
            <p class="col-span-full text-stone-500">Toko ini belum punya produk.</p>
        @endforelse
    </div>
    {{ $products->links('pagination') }}
</div>
@endsection
