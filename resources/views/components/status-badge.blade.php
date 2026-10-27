@props(['status'])
@php
    $styles = [
        'pending' => 'bg-amber-50 text-amber-700 ring-amber-200',
        'paid' => 'bg-sky-50 text-sky-700 ring-sky-200',
        'shipped' => 'bg-indigo-50 text-indigo-700 ring-indigo-200',
        'done' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
        'cancelled' => 'bg-rose-50 text-rose-700 ring-rose-200',
    ];
    $labels = ['pending' => 'Menunggu', 'paid' => 'Dibayar', 'shipped' => 'Dikirim', 'done' => 'Selesai', 'cancelled' => 'Dibatalkan'];
@endphp
<span class="inline-block rounded-full px-2.5 py-1 text-xs font-semibold ring-1 {{ $styles[$status] ?? 'bg-stone-100' }}">{{ $labels[$status] ?? $status }}</span>
