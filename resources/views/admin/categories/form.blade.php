@extends('layouts.admin')
@section('title', $category->exists ? 'Edit Kategori' : 'Tambah Kategori')
@section('content')
<div class="card" style="max-width:500px">
    <h2>{{ $category->exists ? 'Edit Kategori' : 'Tambah Kategori' }}</h2>
    <form method="POST" action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
        @csrf
        @if ($category->exists) @method('PUT') @endif

        <label for="name">Nama Kategori</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required>
        @error('name') <div class="error">{{ $message }}</div> @enderror
        @error('slug') <div class="error">{{ $message }}</div> @enderror
        <br><br>
        <button class="btn">Simpan</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-grey">Batal</a>
    </form>
</div>
@endsection
