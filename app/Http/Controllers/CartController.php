<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Keranjang disimpan di session dengan format [product_id => qty].
 * Harga tidak disimpan di session, selalu diambil ulang dari database.
 */
class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        $total = $products->sum(fn ($p) => $p->price * $cart[$p->id]);

        return view('shop.cart', compact('cart', 'products', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $data = $request->validate([
            'qty' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $cart = $request->session()->get('cart', []);
        $newQty = ($cart[$product->id] ?? 0) + $data['qty'];

        if ($newQty > $product->stock) {
            return back()->with('error', "Stok {$product->name} tidak cukup (sisa {$product->stock}).");
        }

        $cart[$product->id] = $newQty;
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', "{$product->name} masuk ke keranjang.");
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'qty' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        if ($data['qty'] > $product->stock) {
            return back()->with('error', "Stok {$product->name} tidak cukup (sisa {$product->stock}).");
        }

        $cart = $request->session()->get('cart', []);
        $cart[$product->id] = $data['qty'];
        $request->session()->put('cart', $cart);

        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function remove(Request $request, Product $product)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$product->id]);
        $request->session()->put('cart', $cart);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
