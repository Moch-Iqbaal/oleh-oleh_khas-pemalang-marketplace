<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        try {
            // Semua langkah di dalam satu transaksi DB: kalau satu gagal, semuanya dibatalkan
            $transaction = DB::transaction(function () use ($cart, $request) {
                // lockForUpdate mengunci baris produk sampai transaksi selesai,
                // jadi dua customer tidak bisa membeli stok terakhir secara bersamaan
                $products = Product::whereIn('id', array_keys($cart))->lockForUpdate()->get()->keyBy('id');

                $total = 0;
                foreach ($cart as $productId => $qty) {
                    $product = $products->get($productId);
                    if (! $product) {
                        throw new RuntimeException('Ada produk di keranjang yang sudah tidak tersedia.');
                    }
                    if ($product->stock < $qty) {
                        throw new RuntimeException("Stok {$product->name} tidak cukup (sisa {$product->stock}).");
                    }
                    $total += $product->price * $qty;
                }

                $transaction = Transaction::create([
                    'user_id' => $request->user()->id,
                    'invoice_code' => 'INV-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)),
                    'total' => $total,
                    'status' => 'pending',
                ]);

                foreach ($cart as $productId => $qty) {
                    $product = $products->get($productId);
                    // Simpan harga saat ini sebagai snapshot
                    $transaction->items()->create([
                        'product_id' => $product->id,
                        'qty' => $qty,
                        'price' => $product->price,
                    ]);
                    $product->decrement('stock', $qty);
                }

                return $transaction;
            });
        } catch (RuntimeException $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }

        $request->session()->forget('cart');

        return redirect()->route('orders.show', $transaction)
            ->with('success', "Pesanan {$transaction->invoice_code} berhasil dibuat.");
    }
}
