@extends('layouts.app')
@section('title', 'Pesanan Saya')
@section('content')
<div class="card">
    <h2>Pesanan Saya</h2>
    <table>
        <tr><th>Invoice</th><th>Tanggal</th><th>Total</th><th>Status</th><th></th></tr>
        @forelse ($orders as $order)
        <tr>
            <td>{{ $order->invoice_code }}</td>
            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
            <td><span class="badge">{{ $order->status }}</span></td>
            <td><a href="{{ route('orders.show', $order) }}">Detail</a></td>
        </tr>
        @empty
        <tr><td colspan="5">Belum ada pesanan.</td></tr>
        @endforelse
    </table>
    {{ $orders->links('pagination') }}
</div>
@endsection
