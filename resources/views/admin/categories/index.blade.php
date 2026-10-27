@extends('layouts.admin')
@section('title', 'Kategori')
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h2>Kategori</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn">+ Tambah Kategori</a>
    </div>
    <form method="GET" class="row">
        <input type="text" name="q" value="{{ $search }}" placeholder="Cari kategori" style="max-width:300px">
        <button class="btn">Cari</button>
    </form>
    <table>
        <tr><th>Nama</th><th>Slug</th><th>Jumlah Produk</th><th>Aksi</th></tr>
        @forelse ($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>
            <td>{{ $category->products_count }}</td>
            <td class="row">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-grey">Edit</a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="4">Belum ada kategori.</td></tr>
        @endforelse
    </table>
    {{ $categories->links('pagination') }}
</div>
@endsection
