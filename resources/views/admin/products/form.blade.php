@extends('layouts.admin')
@section('title', $product->exists ? 'Edit Produk' : 'Tambah Produk')
@section('content')
<div class="card" style="max-width:600px">
    <h2>{{ $product->exists ? 'Edit Produk' : 'Tambah Produk' }}</h2>
    {{-- enctype wajib supaya file gambar ikut terkirim --}}
    <form method="POST" enctype="multipart/form-data"
          action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}">
        @csrf
        @if ($product->exists) @method('PUT') @endif

        <label for="category_id">Kategori</label>
        <select name="category_id" id="category_id" required>
            <option value="">-- pilih kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id') <div class="error">{{ $message }}</div> @enderror

        <label for="name">Nama Produk</label>
        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
        @error('name') <div class="error">{{ $message }}</div> @enderror
        @error('slug') <div class="error">{{ $message }}</div> @enderror

        <label for="description">Deskripsi</label>
        <textarea name="description" id="description" rows="4">{{ old('description', $product->description) }}</textarea>
        @error('description') <div class="error">{{ $message }}</div> @enderror

        <label for="price">Harga (Rp)</label>
        <input type="number" name="price" id="price" min="100" value="{{ old('price', $product->price) }}" required>
        @error('price') <div class="error">{{ $message }}</div> @enderror

        <label for="stock">Stok</label>
        <input type="number" name="stock" id="stock" min="0" value="{{ old('stock', $product->stock ?? 0) }}" required>
        @error('stock') <div class="error">{{ $message }}</div> @enderror

        <label for="image">Gambar (jpg/png/webp, maks 2 MB)</label>
        @if ($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" alt="" style="max-width:150px;display:block;margin-bottom:6px">
        @endif
        <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp">
        @error('image') <div class="error">{{ $message }}</div> @enderror
        <br><br>
        <button class="btn">Simpan</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-grey">Batal</a>
    </form>
</div>
@endsection
