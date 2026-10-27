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
            $transactions = DB::transaction(function () use ($cart, $request) {
                // lockForUpdate mengunci baris produk sampai transaksi selesai,
                // jadi dua customer tidak bisa membeli stok terakhir secara bersamaan
                $products = Product::with('store')->whereIn('id', array_keys($cart))
                    ->lockForUpdate()->get()->keyBy('id');

                foreach ($cart as $productId => $qty) {
                    $product = $products->get($productId);
                    if (! $product || ! $product->store?->is_verified) {
                        throw new RuntimeException('Ada produk di keranjang yang sudah tidak tersedia.');
                    }
                    if ($product->stock < $qty) {
                        throw new RuntimeException("Stok {$product->name} tidak cukup (sisa {$product->stock}).");
                    }
                }

                // Marketplace: satu pesanan (invoice) untuk setiap toko
                $created = [];
                foreach ($products->groupBy('store_id') as $storeId => $storeProducts) {
                    $total = $storeProducts->sum(fn ($p) => $p->price * $cart[$p->id]);

                    $transaction = Transaction::create([
                        'user_id' => $request->user()->id,
                        'store_id' => $storeId,
                        'invoice_code' => 'INV-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)),
                        'total' => $total,
                        'status' => 'pending',
                    ]);

                    foreach ($storeProducts as $product) {
                        // Simpan harga saat ini sebagai snapshot
                        $transaction->items()->create([
                            'product_id' => $product->id,
                            'qty' => $cart[$product->id],
                            'price' => $product->price,
                        ]);
                        $product->decrement('stock', $cart[$product->id]);
                    }

                    $created[] = $transaction;
                }

                return $created;
            });
        } catch (RuntimeException $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }

        $request->session()->forget('cart');

        $count = count($transactions);
        if ($count === 1) {
            return redirect()->route('orders.show', $transactions[0])
                ->with('success', "Pesanan {$transactions[0]->invoice_code} berhasil dibuat.");
        }

        return redirect()->route('orders.index')
            ->with('success', "Checkout berhasil: {$count} pesanan dibuat, satu untuk setiap toko.");
    }
}
