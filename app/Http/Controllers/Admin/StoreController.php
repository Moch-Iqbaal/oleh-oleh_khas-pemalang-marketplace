<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

// Khusus admin: daftar semua toko dan verifikasi toko baru
class StoreController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');

        $stores = Store::with('owner')->withCount('products')
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('is_verified')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.stores.index', compact('stores', 'search'));
    }

    public function toggleVerification(Store $store)
    {
        $store->update(['is_verified' => ! $store->is_verified]);

        $message = $store->is_verified
            ? "Toko {$store->name} sudah diverifikasi dan produknya tampil di etalase."
            : "Verifikasi toko {$store->name} dicabut, produknya disembunyikan.";

        return back()->with('success', $message);
    }
}
