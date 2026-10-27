@extends('layouts.app')
@section('title', $product->name)
@section('content')
<div class="card product" style="max-width:700px">
    @if ($product->image)
        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" style="height:300px">
    @else
        <img src="https://placehold.co/600x300?text={{ urlencode($product->name) }}" alt="{{ $product->name }}" style="height:300px">
    @endif
    <h2>{{ $product->name }}</h2>
    <span class="badge">{{ $product->category->name }}</span>
    <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
    <p>{{ $product->description }}</p>
    <p>Stok tersedia: {{ $product->stock }}</p>

    @if ($product->stock > 0)
        @auth
            <form action="{{ route('cart.add', $product) }}" method="POST" class="row">
                @csrf
                <input type="number" name="qty" value="1" min="1" max="{{ $product->stock }}" style="max-width:90px">
                <button class="btn">+ Keranjang</button>
            </form>
            @error('qty') <div class="error">{{ $message }}</div> @enderror
        @else
            <p><a href="{{ route('login') }}">Login</a> dulu untuk mulai belanja.</p>
        @endauth
    @else
        <p class="error">Stok habis.</p>
    @endif
</div>
@endsection
