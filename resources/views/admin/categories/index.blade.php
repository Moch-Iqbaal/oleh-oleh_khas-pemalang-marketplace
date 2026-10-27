@extends('layouts.admin')
@section('title', 'Kategori')
@section('content')
<div class="flex flex-wrap items-center justify-between gap-4">
    <h1 class="text-3xl font-extrabold tracking-tight">Kategori</h1>
    <a href="{{ route('admin.categories.create') }}" class="rounded-xl bg-orange-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-orange-500/30 hover:bg-orange-600">+ Tambah kategori</a>
</div>
<form method="GET" class="mt-6 flex gap-3">
    <input type="search" name="q" value="{{ $search }}" placeholder="Cari kategori" class="w-64 rounded-xl px-4 py-2 text-sm ring-1 ring-stone-200 focus:ring-2 focus:ring-orange-400">
    <button class="rounded-xl bg-stone-900 px-4 py-2 text-sm font-semibold text-white">Cari</button>
</form>
<div class="mt-6 overflow-x-auto rounded-2xl bg-white shadow-sm ring-1 ring-stone-200/70">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-left text-xs uppercase tracking-wide text-stone-500">
            <tr><th class="px-5 py-3">Nama</th><th class="px-5 py-3">Slug</th><th class="px-5 py-3">Produk</th><th class="px-5 py-3 text-right">Aksi</th></tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($categories as $category)
                <tr class="hover:bg-stone-50">
                    <td class="px-5 py-3 font-semibold">{{ $category->name }}</td>
                    <td class="px-5 py-3 text-stone-500">{{ $category->slug }}</td>
                    <td class="px-5 py-3">{{ $category->products_count }}</td>
                    <td class="px-5 py-3">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="rounded-lg px-3 py-1.5 font-semibold ring-1 ring-stone-200 hover:ring-orange-400">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" data-confirm="Hapus kategori ini?">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-lg px-3 py-1.5 font-semibold text-rose-600 ring-1 ring-rose-200 hover:bg-rose-50">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-10 text-center text-stone-500">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $categories->links('pagination') }}
@endsection
