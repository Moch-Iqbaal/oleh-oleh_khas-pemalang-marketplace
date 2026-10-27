<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $categorySlug = $request->query('kategori');

        $products = Product::with('category')
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%"))
            ->when($categorySlug, fn ($q) => $q->whereHas('category', fn ($c) => $c->where('slug', $categorySlug)))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('shop.index', compact('products', 'categories', 'search', 'categorySlug'));
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('shop.show', compact('product'));
    }
}
