@extends('layouts.admin')
@section('title', 'Produk')
@section('content')
<div class="flex flex-wrap items-center justify-between gap-4">
    <h1 class="text-3xl font-extrabold tracking-tight">{{ auth()->user()->isSeller() ? 'Produk saya' : 'Semua produk' }}</h1>
    <a href="{{ route('admin.products.create') }}" class="rounded-xl bg-orange-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-orange-500/30 hover:bg-orange-600">+ Tambah produk</a>
</div>
<form method="GET" class="mt-6 flex flex-wrap gap-3">
    <input type="search" name="q" value="{{ $search }}" placeholder="Cari produk" class="w-64 rounded-xl px-4 py-2 text-sm ring-1 ring-stone-200 focus:ring-2 focus:ring-orange-400">
    <select name="category" class="rounded-xl px-4 py-2 text-sm ring-1 ring-stone-200">
        <option value="">Semua kategori</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected($categoryId == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
    <button class="rounded-xl bg-stone-900 px-4 py-2 text-sm font-semibold text-white">Filter</button>
</form>
<div class="mt-6 overflow-x-auto rounded-2xl bg-white shadow-sm ring-1 ring-stone-200/70">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-left text-xs uppercase tracking-wide text-stone-500">
            <tr><th class="px-5 py-3">Produk</th><th class="px-5 py-3">Toko</th><th class="px-5 py-3">Harga</th><th class="px-5 py-3">Stok</th><th class="px-5 py-3">Tahan</th><th class="px-5 py-3 text-right">Aksi</th></tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($products as $product)
                <tr class="hover:bg-stone-50">
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-3">
                            <x-product-image :product="$product" class="h-10 !w-10 rounded-lg" />
                            <div><p class="font-semibold">{{ $product->name }} @if ($product->is_featured)<span title="Unggulan">⭐</span>@endif</p><p class="text-xs text-stone-500">{{ $product->category->name }} · {{ $product->weight_grams }} g</p></div>
                        </div>
                    </td>
                    <td class="px-5 py-3">{{ $product->store?->name }}</td>
                    <td class="px-5 py-3">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-5 py-3"><span class="{{ $product->stock <= 5 ? 'font-bold text-rose-600' : '' }}">{{ $product->stock }}</span></td>
                    <td class="px-5 py-3">{{ $product->shelf_life_days ? $product->shelf_life_days.' hari' : '-' }}</td>
                    <td class="px-5 py-3">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="rounded-lg px-3 py-1.5 font-semibold ring-1 ring-stone-200 hover:ring-orange-400">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-lg px-3 py-1.5 font-semibold text-rose-600 ring-1 ring-rose-200 hover:bg-rose-50">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-5 py-10 text-center text-stone-500">Belum ada produk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $products->links('pagination') }}
@endsection
