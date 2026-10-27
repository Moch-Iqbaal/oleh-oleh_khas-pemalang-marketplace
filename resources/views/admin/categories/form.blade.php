@extends('layouts.admin')
@section('title', $category->exists ? 'Edit Kategori' : 'Tambah Kategori')
@section('content')
<a href="{{ route('admin.categories.index') }}" class="text-sm text-stone-500 hover:text-orange-600">← Kembali</a>
<h1 class="mt-2 text-3xl font-extrabold tracking-tight">{{ $category->exists ? 'Edit kategori' : 'Tambah kategori' }}</h1>
<form method="POST" class="mt-6 max-w-lg space-y-4 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-stone-200/70"
      action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
    @csrf
    @if ($category->exists) @method('PUT') @endif
    <div>
        <label for="name" class="text-sm font-semibold">Nama kategori</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required class="mt-1 w-full rounded-xl px-4 py-2.5 ring-1 ring-stone-200 focus:ring-2 focus:ring-orange-400">
        @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
        @error('slug') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
    </div>
    <button class="rounded-xl bg-orange-500 px-6 py-2.5 font-semibold text-white hover:bg-orange-600">Simpan</button>
</form>
@endsection
