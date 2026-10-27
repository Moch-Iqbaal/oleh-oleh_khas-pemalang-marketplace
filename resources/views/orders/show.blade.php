@extends(auth()->user()->role === 'customer' ? 'layouts.app' : 'layouts.admin')
@section('title', $order->invoice_code)
@section('content')
<div class="mx-auto max-w-3xl {{ auth()->user()->role === 'customer' ? 'px-4 py-10' : '' }}">
    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-stone-200">
        <div class="flex flex-wrap items-start justify-between gap-4 bg-gradient-to-br from-orange-50 to-rose-50 p-6">
            <div>
                <p class="text-sm text-stone-500">Invoice</p>
                <h1 class="text-2xl font-extrabold tracking-tight">{{ $order->invoice_code }}</h1>
                <p class="mt-1 text-sm text-stone-600">🏪 {{ $order->store?->name }} · Pembeli: {{ $order->user->name }}</p>
                <p class="text-sm text-stone-500">{{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
            <x-status-badge :status="$order->status" />
        </div>
        <table class="w-full text-sm">
            <thead class="bg-stone-50 text-left text-xs uppercase tracking-wide text-stone-500">
                <tr><th class="px-6 py-3">Produk</th><th class="px-6 py-3">Harga saat beli</th><th class="px-6 py-3">Qty</th><th class="px-6 py-3 text-right">Subtotal</th></tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @foreach ($order->items as $item)
                    <tr>
                        <td class="px-6 py-4 font-medium">{{ $item->product->name }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $item->qty }}</td>
                        <td class="px-6 py-4 text-right">Rp {{ number_format($item->subtotal(), 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-between border-t border-stone-100 px-6 py-5 text-lg font-extrabold">
            <span>Total</span><span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
        </div>
    </div>
</div>
@endsection
