<?php

namespace App\Http\Controllers\Admin;

use App\Support\Input;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = Input::text($request->query('q'));

        $users = User::query()
            ->when($search, fn ($q) => $q->where(function ($q) use ($search) {
                $q->where('name', 'like', Input::like($search))->orWhere('email', 'like', Input::like($search));
            }))
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'search'));
    }

    public function updateRole(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => ['required', Rule::in(['admin', 'staff', 'seller', 'customer'])],
        ]);

        // Admin tidak boleh menurunkan role dirinya sendiri, biar tidak terkunci dari panel admin
        if ($user->is($request->user())) {
            return back()->with('error', 'Kamu tidak bisa mengubah role akun sendiri.');
        }

        $user->update(['role' => $data['role']]);

        return back()->with('success', "Role {$user->name} diubah menjadi {$data['role']}.");
    }
}
