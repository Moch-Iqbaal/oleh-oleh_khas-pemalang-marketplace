<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    // Riwayat pesanan milik customer yang sedang login saja
    public function index(Request $request)
    {
        $orders = $request->user()->transactions()->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Request $request, Transaction $transaction)
    {
        // Dicek lewat TransactionPolicy::view
        Gate::authorize('view', $transaction);

        $transaction->load('items.product', 'user');

        return view('orders.show', ['order' => $transaction]);
    }
}
