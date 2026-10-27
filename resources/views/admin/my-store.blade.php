@extends('layouts.admin')
@section('title', 'Profil Toko')
@section('content')
@php $input = 'mt-1 w-full rounded-xl px-4 py-2.5 ring-1 ring-stone-200 focus:ring-2 focus:ring-orange-400'; @endphp
<h1 class="text-3xl font-extrabold tracking-tight">Profil toko</h1>
<p class="mt-1 text-sm">Status:
    @if ($store->is_verified)
        <span class="font-semibold text-emerald-600">Terverifikasi <i class="fa-solid fa-circle-check" aria-hidden="true"></i></span> · <a href="{{ route('shop.store', $store) }}" class="text-orange-600">Lihat halaman toko <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
    @else
        <span class="font-semibold text-amber-600">Menunggu verifikasi admin</span>
    @endif
</p>
<form method="POST" enctype="multipart/form-data" action="{{ route('admin.my-store.update') }}" class="mt-6 max-w-2xl space-y-4 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-stone-200/70">
    @csrf
    @method('PUT')
    @foreach ([['name', 'Nama toko'], ['phone', 'No. WhatsApp'], ['address', 'Alamat']] as [$field, $label])
        <div>
            <label for="{{ $field }}" class="text-sm font-semibold">{{ $label }}</label>
            <input type="text" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $store->$field) }}" required class="{{ $input }}">
            @error($field) <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
    @endforeach
    <div>
        <label for="place_name" class="text-sm font-semibold">Nama tempat di Google Maps (contoh: Pasar Moga)</label>
        <input type="text" name="place_name" id="place_name" value="{{ old('place_name', $store->place_name) }}" class="{{ $input }}">
        @error('place_name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>
    <div class="grid gap-4 sm:grid-cols-2">
        @foreach ([['latitude', 'Latitude (contoh -6.8873513)'], ['longitude', 'Longitude (contoh 109.3882311)']] as [$field, $label])
            <div>
                <label for="{{ $field }}" class="text-sm font-semibold">{{ $label }}</label>
                <input type="text" inputmode="decimal" name="{{ $field }}" id="{{ $field }}" value="{{ old($field, $store->$field) }}" class="{{ $input }}">
                @error($field) <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
        @endforeach
        <p class="text-xs text-stone-500 sm:col-span-2">Tips: buka Google Maps, tekan lama titik toko, lalu salin angka koordinatnya.</p>
    </div>
    <div>
        <p class="text-sm font-semibold">Foto toko (jpg/png/webp, maks 2 MB)</p>
        <div class="mt-2 flex items-center gap-4">
            <x-store-avatar :store="$store" class="h-20 w-20 rounded-2xl text-2xl" />
            <input type="file" name="photo" accept="image/jpeg,image/png,image/webp" class="text-sm">
        </div>
        @error('photo') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="description" class="text-sm font-semibold">Deskripsi toko</label>
        <textarea name="description" id="description" rows="4" class="{{ $input }}">{{ old('description', $store->description) }}</textarea>
        @error('description') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>
    <button class="rounded-xl bg-orange-500 px-6 py-2.5 font-semibold text-white hover:bg-orange-600">Simpan</button>
</form>
@endsection
