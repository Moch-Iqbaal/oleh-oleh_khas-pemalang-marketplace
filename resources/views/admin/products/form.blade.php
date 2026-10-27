@extends('layouts.admin')
@section('title', $product->exists ? 'Edit Produk' : 'Tambah Produk')
@section('content')
@php $input = 'mt-1 w-full rounded-xl px-4 py-2.5 ring-1 ring-stone-200 focus:ring-2 focus:ring-orange-400'; @endphp
<a href="{{ route('admin.products.index') }}" class="text-sm text-stone-500 hover:text-orange-600">← Kembali</a>
<h1 class="mt-2 text-3xl font-extrabold tracking-tight">{{ $product->exists ? 'Edit produk' : 'Tambah produk' }}</h1>
{{-- enctype wajib supaya file gambar ikut terkirim --}}
<form method="POST" enctype="multipart/form-data" class="mt-6 grid gap-6 lg:grid-cols-3"
      action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}">
    @csrf
    @if ($product->exists) @method('PUT') @endif
    <div class="space-y-4 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-stone-200/70 lg:col-span-2">
        @if (auth()->user()->isPlatformStaff())
            <div>
                <label for="store_id" class="text-sm font-semibold">Toko</label>
                <select name="store_id" id="store_id" required class="{{ $input }}">
                    <option value="">-- pilih toko --</option>
                    @foreach ($stores as $store)
                        <option value="{{ $store->id }}" @selected(old('store_id', $product->store_id) == $store->id)>{{ $store->name }}</option>
                    @endforeach
                </select>
                @error('store_id') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
        @endif
        <div>
            <label for="name" class="text-sm font-semibold">Nama produk</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="{{ $input }}">
            @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            @error('slug') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="category_id" class="text-sm font-semibold">Kategori</label>
            <select name="category_id" id="category_id" required class="{{ $input }}">
                <option value="">-- pilih kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="description" class="text-sm font-semibold">Deskripsi</label>
            <textarea name="description" id="description" rows="5" class="{{ $input }}">{{ old('description', $product->description) }}</textarea>
            @error('description') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach ([['price', 'Harga (Rp)', 100, true], ['stock', 'Stok', 0, true], ['weight_grams', 'Berat (gram)', 1, true], ['shelf_life_days', 'Tahan berapa hari (kosongkan kalau tidak basi)', 1, false]] as [$field, $label, $min, $required])
                <div>
                    <label for="{{ $field }}" class="text-sm font-semibold">{{ $label }}</label>
                    <input type="number" name="{{ $field }}" id="{{ $field }}" min="{{ $min }}" value="{{ old($field, $product->$field) }}" @required($required) class="{{ $input }}">
                    @error($field) <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
                </div>
            @endforeach
        </div>
    </div>
    <div class="space-y-4">
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-stone-200/70">
            <p class="text-sm font-semibold">Gambar produk</p>
            <div class="mt-3 overflow-hidden rounded-xl">
                <x-product-image :product="$product->exists ? $product : new \App\Models\Product(['name' => 'Produk'])" class="h-40" />
            </div>
            <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp" class="mt-3 w-full text-sm">
            <p class="mt-1 text-xs text-stone-500">jpg/png/webp, maks 2 MB</p>
            @error('image') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        </div>
        <label class="flex items-center gap-3 rounded-2xl bg-white p-6 text-sm font-semibold shadow-sm ring-1 ring-stone-200/70">
            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured)) class="h-5 w-5 rounded">
            ⭐ Tampilkan sebagai produk unggulan
        </label>
        <button class="w-full rounded-xl bg-orange-500 py-3 font-semibold text-white shadow-lg shadow-orange-500/30 hover:bg-orange-600">Simpan produk</button>
    </div>
</form>
@endsection
