<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

// Seller mengubah profil tokonya sendiri (status verifikasi tidak bisa diubah di sini)
class MyStoreController extends Controller
{
    public function edit(Request $request)
    {
        $store = $request->user()->store ?? abort(404);

        return view('admin.my-store', compact('store'));
    }

    public function update(Request $request)
    {
        $store = $request->user()->store ?? abort(404);

        $data = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100', Rule::unique('stores', 'name')->ignore($store->id)],
            'description' => ['nullable', 'string', 'max:1000'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[0-9+ ]{8,20}$/'],
        ]);

        $store->update($data);

        return back()->with('success', 'Profil toko berhasil disimpan.');
    }
}
