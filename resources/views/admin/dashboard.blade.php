@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="flex flex-wrap items-end justify-between gap-4">
    <div>
        <p class="text-sm text-stone-500">Halo, {{ auth()->user()->name }} 👋</p>
        <h1 class="text-3xl font-extrabold tracking-tight">{{ $store && auth()->user()->isSeller() ? $store->name : 'Ringkasan marketplace' }}</h1>
    </div>
    @if (auth()->user()->isSeller())
        <a href="{{ route('admin.products.create') }}" class="rounded-xl bg-orange-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-orange-500/30 hover:bg-orange-600">+ Tambah produk</a>
    @endif
</div>

@if (auth()->user()->isSeller() && $store && ! $store->is_verified)
    <div class="mt-6 rounded-2xl bg-amber-50 p-4 text-sm text-amber-800 ring-1 ring-amber-200">⏳ Toko kamu sedang menunggu verifikasi admin. Produk belum tampil di etalase sampai toko diverifikasi.</div>
@endif

@php
    $cards = [
        ['Produk', $stats['products'], '📦', 'from-orange-500 to-rose-500'],
        ['Total pesanan', $stats['orders'], '🧾', 'from-sky-500 to-indigo-500'],
        ['Pesanan menunggu', $stats['pending'], '⏳', 'from-amber-500 to-orange-500'],
        ['Pendapatan', 'Rp '.number_format($stats['revenue'], 0, ',', '.'), '💰', 'from-emerald-500 to-teal-500'],
    ];
    if (isset($stats['stores'])) {
        $cards[] = ['Toko UMKM', $stats['stores'], '🏪', 'from-violet-500 to-fuchsia-500'];
        $cards[] = ['Toko belum diverifikasi', $stats['pending_stores'], '✅', 'from-rose-500 to-pink-500'];
        $cards[] = ['Customer', $stats['customers'], '👥', 'from-stone-600 to-stone-800'];
    }
@endphp
<div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    @foreach ($cards as [$label, $value, $icon, $gradient])
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-stone-200/70">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-stone-500">{{ $label }}</p>
                <span class="grid h-10 w-10 place-items-center rounded-xl bg-gradient-to-br {{ $gradient }} text-lg">{{ $icon }}</span>
            </div>
            <p class="mt-3 text-2xl font-extrabold tracking-tight">{{ $value }}</p>
        </div>
    @endforeach
</div>

<div class="mt-8 grid gap-6 lg:grid-cols-5">
    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-stone-200/70 lg:col-span-3">
        <div class="flex items-center justify-between px-5 py-4">
            <h2 class="font-bold">Pesanan terbaru</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold text-orange-600">Lihat semua →</a>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-stone-100">
                @forelse ($latestOrders as $order)
                    <tr class="hover:bg-stone-50">
                        <td class="px-5 py-3"><a href="{{ route('orders.show', $order) }}" class="font-semibold hover:text-orange-600">{{ $order->invoice_code }}</a><p class="text-xs text-stone-500">{{ $order->user->name }} · {{ $order->store?->name }}</p></td>
                        <td class="px-5 py-3"><x-status-badge :status="$order->status" /></td>
                        <td class="px-5 py-3 text-right font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td class="px-5 py-8 text-center text-stone-500">Belum ada pesanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-stone-200/70 lg:col-span-2">
        <h2 class="px-5 py-4 font-bold">Stok menipis (≤ 5)</h2>
        <ul class="divide-y divide-stone-100 text-sm">
            @forelse ($lowStock as $product)
                <li class="flex items-center justify-between px-5 py-3"><span>{{ $product->name }}</span><span class="rounded-full bg-rose-50 px-2 py-0.5 text-xs font-bold text-rose-600">{{ $product->stock }}</span></li>
            @empty
                <li class="px-5 py-8 text-center text-stone-500">Semua stok aman 👍</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
