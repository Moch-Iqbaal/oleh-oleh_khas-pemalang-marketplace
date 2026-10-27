@extends('layouts.app')
@section('title', 'Keranjang')
@section('content')
<div class="card">
    <h2>Keranjang Belanja</h2>
    @if ($products->isEmpty())
        <p>Keranjang masih kosong. <a href="{{ route('home') }}">Belanja sekarang</a></p>
    @else
        <table>
            <tr><th>Produk</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th></th></tr>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('cart.update', $product) }}" method="POST" class="row">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="qty" value="{{ $cart[$product->id] }}" min="1" max="{{ $product->stock }}" style="max-width:80px">
                        <button class="btn btn-sm btn-grey">Ubah</button>
                    </form>
                </td>
                <td>Rp {{ number_format($product->price * $cart[$product->id], 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('cart.remove', $product) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <h3>Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <button class="btn">Checkout</button>
        </form>
    @endif
</div>
@endsection
