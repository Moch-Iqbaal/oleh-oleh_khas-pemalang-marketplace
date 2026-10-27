@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<h2>Dashboard</h2>
<div class="stats">
    <div class="card"><div>Total Produk</div><div class="num">{{ $stats['products'] }}</div></div>
    <div class="card"><div>Customer</div><div class="num">{{ $stats['customers'] }}</div></div>
    <div class="card"><div>Total Pesanan</div><div class="num">{{ $stats['orders'] }}</div></div>
    <div class="card"><div>Pesanan Pending</div><div class="num">{{ $stats['pending'] }}</div></div>
    <div class="card"><div>Pendapatan</div><div class="num" style="font-size:1.3rem">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</div></div>
</div>
<div class="card">
    <h3>Stok Menipis (&le; 5)</h3>
    <table>
        <tr><th>Produk</th><th>Stok</th></tr>
        @forelse ($lowStock as $product)
            <tr><td>{{ $product->name }}</td><td>{{ $product->stock }}</td></tr>
        @empty
            <tr><td colspan="2">Semua stok aman.</td></tr>
        @endforelse
    </table>
</div>
<div class="card">
    <h3>Pesanan Terbaru</h3>
    <table>
        <tr><th>Invoice</th><th>Pembeli</th><th>Total</th><th>Status</th></tr>
        @forelse ($latestOrders as $order)
            <tr>
                <td><a href="{{ route('orders.show', $order) }}">{{ $order->invoice_code }}</a></td>
                <td>{{ $order->user->name }}</td>
                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                <td><span class="badge">{{ $order->status }}</span></td>
            </tr>
        @empty
            <tr><td colspan="4">Belum ada pesanan.</td></tr>
        @endforelse
    </table>
</div>
@endsection
