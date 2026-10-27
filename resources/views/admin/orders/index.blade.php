@extends('layouts.admin')
@section('title', 'Pesanan')
@section('content')
<div class="card">
    <h2>Semua Pesanan</h2>
    <form method="GET" class="row">
        <input type="text" name="q" value="{{ $search }}" placeholder="Cari kode invoice" style="max-width:250px">
        <select name="status" style="max-width:180px">
            <option value="">Semua status</option>
            @foreach (\App\Models\Transaction::STATUSES as $s)
                <option value="{{ $s }}" @selected($status === $s)>{{ $s }}</option>
            @endforeach
        </select>
        <button class="btn">Filter</button>
    </form>
    <table>
        <tr><th>Invoice</th><th>Pembeli</th><th>Tanggal</th><th>Total</th><th>Status</th></tr>
        @forelse ($orders as $order)
        <tr>
            <td><a href="{{ route('orders.show', $order) }}">{{ $order->invoice_code }}</a></td>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
            <td>
                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="row">
                    @csrf
                    @method('PATCH')
                    <select name="status" style="max-width:130px">
                        @foreach (\App\Models\Transaction::STATUSES as $s)
                            <option value="{{ $s }}" @selected($order->status === $s)>{{ $s }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm">Simpan</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5">Belum ada pesanan.</td></tr>
        @endforelse
    </table>
    {{ $orders->links('pagination') }}
</div>
@endsection
