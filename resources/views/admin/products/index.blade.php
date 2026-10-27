@extends('layouts.admin')
@section('title', 'Produk')
@section('content')
<div class="card">
    <div class="row" style="justify-content:space-between">
        <h2>Produk</h2>
        <a href="{{ route('admin.products.create') }}" class="btn">+ Tambah Produk</a>
    </div>
    <form method="GET" class="row">
        <input type="text" name="q" value="{{ $search }}" placeholder="Cari produk" style="max-width:250px">
        <select name="category" style="max-width:200px">
            <option value="">Semua kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected($categoryId == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <button class="btn">Filter</button>
    </form>
    <table>
        <tr><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
        @forelse ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name }}</td>
            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td>{{ $product->stock }}</td>
            <td class="row">
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-grey">Edit</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Hapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5">Produk tidak ditemukan.</td></tr>
        @endforelse
    </table>
    {{ $products->links('pagination') }}
</div>
@endsection
