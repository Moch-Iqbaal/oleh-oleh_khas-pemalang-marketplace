@extends('layouts.app')
@section('title', 'Belanja')
@section('content')
<div class="card">
    <h2>Produk UMKM Lokal</h2>
    <form method="GET" class="row">
        <input type="text" name="q" value="{{ $search }}" placeholder="Cari produk..." style="max-width:300px">
        @if ($categorySlug) <input type="hidden" name="kategori" value="{{ $categorySlug }}"> @endif
        <button class="btn">Cari</button>
    </form>
    <div class="row" style="margin-top:12px">
        <a class="badge" href="{{ route('home') }}">Semua</a>
        @foreach ($categories as $category)
            <a class="badge" href="{{ route('home', ['kategori' => $category->slug]) }}"
               @if ($categorySlug === $category->slug) style="background:#1d6f42;color:#fff" @endif>{{ $category->name }}</a>
        @endforeach
    </div>
</div>
<div class="grid">
    @forelse ($products as $product)
        <div class="card product">
            @if ($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
            @else
                <img src="https://placehold.co/400x300?text={{ urlencode($product->name) }}" alt="{{ $product->name }}">
            @endif
            <h3><a href="{{ route('shop.show', $product) }}">{{ $product->name }}</a></h3>
            <div class="badge">{{ $product->category->name }}</div>
            <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <small>Stok: {{ $product->stock }}</small>
        </div>
    @empty
        <p>Produk tidak ditemukan.</p>
    @endforelse
</div>
{{ $products->links('pagination') }}
@endsection
