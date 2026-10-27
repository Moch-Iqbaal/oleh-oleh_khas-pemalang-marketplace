<?php

namespace App\Http\Controllers\Auth;

use App\Support\Input;
use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->merge(collect($request->only('name', 'store_name', 'store_address'))->map(fn ($v) => Input::clean($v))->all());
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
            // Whitelist: dari form publik hanya boleh jadi customer atau seller, tidak pernah admin/staff
            'account_type' => ['required', Rule::in(['customer', 'seller'])],
            'store_name' => ['exclude_unless:account_type,seller', 'required', 'string', 'min:3', 'max:100', 'unique:stores,name'],
            'store_phone' => ['exclude_unless:account_type,seller', 'required', 'string', 'regex:/^[0-9+ ]{8,20}$/'],
            'store_address' => ['exclude_unless:account_type,seller', 'required', 'string', 'max:255'],
        ]);

        // User dan toko dibuat bersamaan; kalau salah satu gagal, dua-duanya batal
        $user = DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $data['account_type'],
            ]);

            if ($data['account_type'] === 'seller') {
                Store::create([
                    'user_id' => $user->id,
                    'name' => $data['store_name'],
                    'slug' => Str::slug($data['store_name']),
                    'phone' => $data['store_phone'],
                    'address' => $data['store_address'],
                    'is_verified' => false,
                ]);
            }

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        if ($user->isSeller()) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Toko kamu sudah terdaftar dan menunggu verifikasi admin. Sambil menunggu, kamu bisa mulai menambah produk.');
        }

        return redirect()->route('home')->with('success', 'Registrasi berhasil, selamat datang!');
    }
}
