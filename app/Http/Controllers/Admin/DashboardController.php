<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        // Seller: statistik tokonya saja. Admin/staff: seluruh marketplace
        $storeId = $user->isSeller() ? $user->store?->id : null;

        $products = Product::query()->when($storeId, fn ($q) => $q->where('store_id', $storeId));
        $orders = Transaction::query()->when($storeId, fn ($q) => $q->where('store_id', $storeId));

        $stats = [
            'products' => (clone $products)->count(),
            'orders' => (clone $orders)->count(),
            'pending' => (clone $orders)->where('status', 'pending')->count(),
            // Pendapatan hanya dari pesanan yang tidak dibatalkan dan sudah dibayar
            'revenue' => (clone $orders)->whereIn('status', ['paid', 'shipped', 'done'])->sum('total'),
        ];

        if (! $storeId) {
            $stats['stores'] = Store::count();
            $stats['pending_stores'] = Store::where('is_verified', false)->count();
            $stats['customers'] = User::where('role', 'customer')->count();
        }

        $lowStock = (clone $products)->with('store')->where('stock', '<=', 5)->orderBy('stock')->take(5)->get();
        $latestOrders = (clone $orders)->with('user', 'store')->latest()->take(5)->get();
        $store = $user->store;

        return view('admin.dashboard', compact('stats', 'lowStock', 'latestOrders', 'store'));
    }
}
