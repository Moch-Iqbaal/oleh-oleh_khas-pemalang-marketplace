@extends('layouts.admin')
@section('title', 'Verifikasi Toko')
@section('content')
<h1 class="text-3xl font-extrabold tracking-tight">Toko UMKM</h1>
<p class="mt-1 text-sm text-stone-500">Produk dari toko yang belum diverifikasi tidak tampil di etalase.</p>
<form method="GET" class="mt-6 flex gap-3">
    <input type="search" name="q" value="{{ $search }}" placeholder="Cari nama toko" class="w-64 rounded-xl px-4 py-2 text-sm ring-1 ring-stone-200 focus:ring-2 focus:ring-orange-400">
    <button class="rounded-xl bg-stone-900 px-4 py-2 text-sm font-semibold text-white">Cari</button>
</form>
<div class="mt-6 grid gap-4 md:grid-cols-2">
    @forelse ($stores as $store)
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-stone-200/70">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="font-bold">{{ $store->name }}</p>
                    <p class="text-sm text-stone-500">{{ $store->owner->name }} · {{ $store->owner->email }}</p>
                    <p class="mt-1 text-sm text-stone-500">📍 {{ $store->address }} · 📞 {{ $store->phone }}</p>
                    <p class="mt-1 text-xs text-stone-400">{{ $store->products_count }} produk</p>
                </div>
                @if ($store->is_verified)
                    <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">Terverifikasi</span>
                @else
                    <span class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700 ring-1 ring-amber-200">Menunggu</span>
                @endif
            </div>
            <form action="{{ route('admin.stores.verify', $store) }}" method="POST" class="mt-4">
                @csrf
                @method('PATCH')
                <button class="rounded-lg px-4 py-2 text-sm font-semibold {{ $store->is_verified ? 'text-rose-600 ring-1 ring-rose-200 hover:bg-rose-50' : 'bg-emerald-600 text-white hover:bg-emerald-700' }}">
                    {{ $store->is_verified ? 'Cabut verifikasi' : 'Verifikasi toko' }}
                </button>
            </form>
        </div>
    @empty
        <p class="text-stone-500">Belum ada toko.</p>
    @endforelse
</div>
{{ $stores->links('pagination') }}
@endsection
