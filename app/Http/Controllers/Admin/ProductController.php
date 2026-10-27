<?php

namespace App\Http\Controllers\Admin;

use App\Support\Input;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $search = Input::text($request->query('q'));
        $categoryId = $request->query('category');

        $products = Product::with('category', 'store')
            // Seller hanya melihat produk tokonya sendiri
            ->when($user->isSeller(), fn ($q) => $q->where('store_id', $user->store?->id))
            ->when($search, fn ($q) => $q->where('name', 'like', Input::like($search)))
            ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories', 'search', 'categoryId'));
    }

    public function create(Request $request)
    {
        $this->ensureSellerHasStore($request);

        return view('admin.products.form', $this->formData(new Product()));
    }

    public function store(ProductRequest $request)
    {
        $this->ensureSellerHasStore($request);
        $data = $request->validated();

        if ($request->user()->isSeller()) {
            $data['store_id'] = $request->user()->store->id;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        return view('admin.products.form', $this->formData($product));
    }

    public function update(ProductRequest $request, Product $product)
    {
        Gate::authorize('update', $product);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Hapus gambar lama supaya storage tidak penuh file yatim
            if ($product->isUploadedImage()) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            unset($data['image']);
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);

        // Produk yang sudah pernah dibeli tidak dihapus agar riwayat transaksi tetap utuh
        if ($product->items()->exists()) {
            return back()->with('error', 'Produk sudah ada di transaksi, tidak bisa dihapus. Ubah stok jadi 0 saja.');
        }

        if ($product->isUploadedImage()) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }

    private function formData(Product $product): array
    {
        return [
            'product' => $product,
            'categories' => Category::orderBy('name')->get(),
            'stores' => Store::orderBy('name')->get(),
        ];
    }

    private function ensureSellerHasStore(Request $request): void
    {
        if ($request->user()->isSeller() && ! $request->user()->store) {
            abort(403, 'Akun seller ini belum punya toko.');
        }
    }
}
