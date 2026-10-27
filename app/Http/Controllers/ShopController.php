<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $categorySlug = $request->query('kategori');

        $products = Product::visible()->with('category', 'store')
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%"))
            ->when($categorySlug, fn ($q) => $q->whereHas('category', fn ($c) => $c->where('slug', $categorySlug)))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // Bagian "unggulan" hanya tampil di halaman utama tanpa filter
        $featured = ($search || $categorySlug)
            ? collect()
            : Product::visible()->with('store')->where('is_featured', true)->take(4)->get();

        $categories = Category::withCount(['products' => fn ($q) => $q->visible()])->orderBy('name')->get();
        $stores = Store::verified()->withCount('products')->orderBy('name')->get();

        return view('shop.index', compact('products', 'featured', 'categories', 'stores', 'search', 'categorySlug'));
    }

    public function show(Product $product)
    {
        // Produk dari toko yang belum diverifikasi dianggap tidak ada
        abort_unless($product->store?->is_verified, 404);
        $product->load('category', 'store');

        $related = Product::visible()->with('store')
            ->where('store_id', $product->store_id)
            ->whereKeyNot($product->id)
            ->take(4)->get();

        return view('shop.show', compact('product', 'related'));
    }

    public function store(Store $store)
    {
        abort_unless($store->is_verified, 404);

        $products = $store->products()->with('category')->latest()->paginate(12);

        return view('shop.store', compact('store', 'products'));
    }
}
