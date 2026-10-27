@props(['product'])
<a href="{{ route('shop.show', $product) }}" class="group block overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-stone-200/70 transition duration-300 hover:-translate-y-1 hover:shadow-xl">
    <div class="relative overflow-hidden">
        <x-product-image :product="$product" class="h-44 transition duration-500 group-hover:scale-105" />
        @if ($product->is_featured)
            <span class="absolute left-3 top-3 rounded-full bg-white/90 px-2.5 py-1 text-xs font-semibold text-orange-600 backdrop-blur"><i class="fa-solid fa-star" aria-hidden="true"></i> Unggulan</span>
        @endif
        @if ($product->stock < 1)
            <span class="absolute right-3 top-3 rounded-full bg-stone-900/80 px-2.5 py-1 text-xs font-semibold text-white">Habis</span>
        @endif
    </div>
    <div class="p-4">
        <p class="truncate text-xs font-medium text-emerald-700">{{ $product->store->name }}</p>
        <h3 class="mt-1 line-clamp-2 min-h-[2.75rem] font-semibold leading-snug text-stone-800 group-hover:text-orange-600">{{ $product->name }}</h3>
        <div class="mt-3 flex items-end justify-between">
            <p class="text-lg font-extrabold text-stone-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="text-xs text-stone-500">{{ $product->weight_grams }} g</p>
        </div>
    </div>
</a>
