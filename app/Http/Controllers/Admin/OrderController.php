<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('q');

        $orders = Transaction::with('user')
            ->when($status, fn ($q) => $q->where('status', $status))
            ->when($search, fn ($q) => $q->where('invoice_code', 'like', "%{$search}%"))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.orders.index', compact('orders', 'status', 'search'));
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(Transaction::STATUSES)],
        ]);

        $transaction->update($data);

        return back()->with('success', "Status {$transaction->invoice_code} diubah menjadi {$data['status']}.");
    }
}
