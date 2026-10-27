@props(['store'])
{{-- Lokasi toko: peta OpenStreetMap (tanpa API key) + jarak dari lokasi pembeli --}}
<div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-stone-200/70">
    <div class="p-5">
        <p class="font-semibold"><i class="fa-solid fa-location-dot text-rose-500" aria-hidden="true"></i> Lokasi toko</p>
        <p class="mt-1 text-sm text-stone-600">{{ $store->address }}</p>
        @if ($store->hasLocation())
            <p class="mt-2 text-sm font-semibold text-orange-600 js-distance" data-lat="{{ $store->latitude }}" data-lng="{{ $store->longitude }}">Menghitung jarak dari lokasi kamu...</p>
            <a href="{{ $store->mapsUrl() }}" target="_blank" rel="noopener" class="mt-2 inline-block text-sm font-semibold text-emerald-700 hover:underline">Buka di Google Maps <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
        @endif
    </div>
    @if ($store->hasLocation())
        @php
            $d = 0.01;
            $bbox = ($store->longitude - $d).','.($store->latitude - $d).','.($store->longitude + $d).','.($store->latitude + $d);
        @endphp
        <iframe title="Peta {{ $store->name }}" class="h-56 w-full border-0" loading="lazy"
                src="https://www.openstreetmap.org/export/embed.html?bbox={{ urlencode($bbox) }}&layer=mapnik&marker={{ $store->latitude }},{{ $store->longitude }}"></iframe>
    @endif
</div>
@once
<script nonce="{{ $cspNonce ?? '' }}">
// Hitung jarak lurus (Haversine) dari lokasi browser ke toko. Lokasi pembeli tidak dikirim ke server.
(function () {
    const els = document.querySelectorAll('.js-distance');
    if (!els.length) return;
    const fail = (msg) => els.forEach(el => el.textContent = msg);
    if (!('geolocation' in navigator)) return fail('Browser tidak mendukung lokasi, jarak tidak bisa dihitung.');

    const haversine = (lat1, lng1, lat2, lng2) => {
        const R = 6371000, rad = x => x * Math.PI / 180;
        const dLat = rad(lat2 - lat1), dLng = rad(lng2 - lng1);
        const a = Math.sin(dLat / 2) ** 2 + Math.cos(rad(lat1)) * Math.cos(rad(lat2)) * Math.sin(dLng / 2) ** 2;
        return 2 * R * Math.asin(Math.sqrt(a));
    };

    navigator.geolocation.getCurrentPosition(pos => {
        els.forEach(el => {
            const m = haversine(pos.coords.latitude, pos.coords.longitude, parseFloat(el.dataset.lat), parseFloat(el.dataset.lng));
            const text = m < 1000 ? Math.round(m) + ' m' : (m / 1000).toFixed(1).replace('.', ',') + ' km';
            el.textContent = 'Jarak dari lokasi kamu: ' + text + ' (garis lurus)';
        });
    }, () => fail('Izinkan akses lokasi di browser untuk melihat jarak ke toko.'), { timeout: 10000, maximumAge: 600000 });
})();
</script>
@endonce
