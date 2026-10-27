@props(['store', 'class' => 'h-12 w-12 rounded-xl'])
@if ($url = $store->photoUrl())
    <img src="{{ $url }}" alt="Foto {{ $store->name }}" loading="lazy" {{ $attributes->merge(['class' => "shrink-0 object-cover $class"]) }}>
@else
    <span {{ $attributes->merge(['class' => "grid shrink-0 place-items-center bg-gradient-to-br from-emerald-500 to-teal-600 font-extrabold text-white $class"]) }}>{{ mb_substr($store->name, 0, 1) }}</span>
@endif
