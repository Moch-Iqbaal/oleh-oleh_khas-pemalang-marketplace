@extends('layouts.app')
@section('title', $order->invoice_code)
@section('content')
<div class="card">
    <h2>Invoice {{ $order->invoice_code }}</h2>
    <p>Pembeli: {{ $order->user->name }} &middot; {{ $order->created_at->format('d M Y H:i') }}</p>
    <p>Status: <span class="badge">{{ $order->status }}</span></p>
    <table>
        <tr><th>Produk</th><th>Harga Saat Beli</th><th>Jumlah</th><th>Subtotal</th></tr>
        @foreach ($order->items as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            <td>{{ $item->qty }}</td>
            <td>Rp {{ number_format($item->subtotal(), 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>
    <h3>Total: Rp {{ number_format($order->total, 0, ',', '.') }}</h3>
</div>
@endsection
