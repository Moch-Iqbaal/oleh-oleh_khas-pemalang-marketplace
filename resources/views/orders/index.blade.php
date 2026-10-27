@extends('layouts.app')
@section('title', 'Pesanan Saya')
@section('content')
<div class="mx-auto max-w-4xl px-4 py-10">
    <h1 class="text-3xl font-extrabold tracking-tight">Pesanan saya</h1>
    <div class="mt-8 space-y-3">
        @forelse ($orders as $order)
            <a href="{{ route('orders.show', $order) }}" class="flex flex-wrap items-center gap-4 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-stone-200 transition hover:shadow-md hover:ring-orange-300">
                <div class="flex-1">
                    <p class="font-bold">{{ $order->invoice_code }}</p>
                    <p class="text-sm text-stone-500"><i class="fa-solid fa-store" aria-hidden="true"></i> {{ $order->store?->name }} · {{ $order->created_at->format('d M Y H:i') }}</p>
                </div>
                <x-status-badge :status="$order->status" />
                <p class="w-32 text-right font-extrabold">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
            </a>
        @empty
            <div class="rounded-3xl bg-white p-12 text-center text-stone-500 ring-1 ring-stone-200">Belum ada pesanan.</div>
        @endforelse
    </div>
    {{ $orders->links('pagination') }}
</div>
@endsection
