<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'customers' => User::where('role', 'customer')->count(),
            'orders' => Transaction::count(),
            'pending' => Transaction::where('status', 'pending')->count(),
            // Pendapatan hanya dari pesanan yang tidak dibatalkan
            'revenue' => Transaction::whereIn('status', ['paid', 'shipped', 'done'])->sum('total'),
        ];

        $lowStock = Product::where('stock', '<=', 5)->orderBy('stock')->take(5)->get();
        $latestOrders = Transaction::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'lowStock', 'latestOrders'));
    }
}
