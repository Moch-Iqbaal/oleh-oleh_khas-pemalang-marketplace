@props(['product', 'class' => 'h-48'])
@php
    // Placeholder SVG lokal (gradient + huruf awal) supaya tetap tampil tanpa internet
    $palettes = [
        ['#f97316', '#be123c'], ['#059669', '#0f766e'], ['#7c3aed', '#db2777'],
        ['#0284c7', '#4f46e5'], ['#ca8a04', '#c2410c'], ['#16a34a', '#65a30d'],
    ];
    [$from, $to] = $palettes[abs(crc32($product->name)) % count($palettes)];
    $initial = mb_strtoupper(mb_substr($product->name, 0, 1));
    $gid = 'g'.$product->id;
@endphp
@if ($url = $product->imageUrl())
    <img src="{{ $url }}" loading="lazy" alt="{{ $product->name }}" {{ $attributes->merge(['class' => "w-full object-cover $class"]) }}>
@else
    <svg viewBox="0 0 400 300" preserveAspectRatio="xMidYMid slice" role="img" aria-label="{{ $product->name }}" {{ $attributes->merge(['class' => "w-full $class"]) }}>
        <defs>
            <linearGradient id="{{ $gid }}" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0" stop-color="{{ $from }}"/>
                <stop offset="1" stop-color="{{ $to }}"/>
            </linearGradient>
        </defs>
        <rect width="400" height="300" fill="url(#{{ $gid }})"/>
        <circle cx="340" cy="40" r="90" fill="#fff" fill-opacity=".08"/>
        <circle cx="40" cy="280" r="70" fill="#fff" fill-opacity=".08"/>
        <text x="200" y="150" text-anchor="middle" dominant-baseline="central" font-family="Plus Jakarta Sans, sans-serif" font-size="120" font-weight="800" fill="#fff" fill-opacity=".9">{{ $initial }}</text>
    </svg>
@endif
