@extends('layouts.admin')
@section('title', 'Pesanan')
@section('content')
<h1 class="text-3xl font-extrabold tracking-tight">{{ auth()->user()->isSeller() ? 'Pesanan toko saya' : 'Semua pesanan' }}</h1>
<form method="GET" class="mt-6 flex flex-wrap gap-3">
    <input type="search" name="q" value="{{ $search }}" placeholder="Cari kode invoice" class="w-64 rounded-xl px-4 py-2 text-sm ring-1 ring-stone-200 focus:ring-2 focus:ring-orange-400">
    <select name="status" class="rounded-xl px-4 py-2 text-sm ring-1 ring-stone-200">
        <option value="">Semua status</option>
        @foreach (\App\Models\Transaction::STATUSES as $s)
            <option value="{{ $s }}" @selected($status === $s)>{{ $s }}</option>
        @endforeach
    </select>
    <button class="rounded-xl bg-stone-900 px-4 py-2 text-sm font-semibold text-white">Filter</button>
</form>
<div class="mt-6 overflow-x-auto rounded-2xl bg-white shadow-sm ring-1 ring-stone-200/70">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-left text-xs uppercase tracking-wide text-stone-500">
            <tr><th class="px-5 py-3">Invoice</th><th class="px-5 py-3">Pembeli</th><th class="px-5 py-3">Toko</th><th class="px-5 py-3">Total</th><th class="px-5 py-3">Status</th><th class="px-5 py-3">Ubah status</th></tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($orders as $order)
                <tr class="hover:bg-stone-50">
                    <td class="px-5 py-3"><a href="{{ route('orders.show', $order) }}" class="font-semibold hover:text-orange-600">{{ $order->invoice_code }}</a><p class="text-xs text-stone-500">{{ $order->created_at->format('d M Y H:i') }}</p></td>
                    <td class="px-5 py-3">{{ $order->user->name }}</td>
                    <td class="px-5 py-3">{{ $order->store?->name }}</td>
                    <td class="px-5 py-3 font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td class="px-5 py-3"><x-status-badge :status="$order->status" /></td>
                    <td class="px-5 py-3">
                        <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="flex gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="rounded-lg px-2 py-1.5 text-sm ring-1 ring-stone-200">
                                @foreach (\App\Models\Transaction::STATUSES as $s)
                                    <option value="{{ $s }}" @selected($order->status === $s)>{{ $s }}</option>
                                @endforeach
                            </select>
                            <button class="rounded-lg bg-stone-900 px-3 py-1.5 font-semibold text-white">Simpan</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-5 py-10 text-center text-stone-500">Belum ada pesanan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $orders->links('pagination') }}
@endsection
