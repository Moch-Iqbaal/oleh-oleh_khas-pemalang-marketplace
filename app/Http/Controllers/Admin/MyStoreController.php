<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            // Koordinat boleh kosong, tapi kalau diisi harus berpasangan dan dalam rentang valid
            'latitude' => ['nullable', 'required_with:longitude', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'required_with:latitude', 'numeric', 'between:-180,180'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            // Foto upload lama dihapus; foto bawaan seeder (public/images) dibiarkan
            if ($store->photo && ! str_starts_with($store->photo, 'images/')) {
                Storage::disk('public')->delete($store->photo);
            }
            $data['photo'] = $request->file('photo')->store('stores', 'public');
        } else {
            unset($data['photo']);
        }

        $store->update($data);

        return back()->with('success', 'Profil toko berhasil disimpan.');
    }
}
