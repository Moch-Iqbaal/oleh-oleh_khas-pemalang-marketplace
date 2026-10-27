<?php

// Pesan validasi Bahasa Indonesia (hanya aturan yang dipakai di aplikasi ini)
return [
    'required' => ':attribute wajib diisi.',
    'string' => ':attribute harus berupa teks.',
    'email' => ':attribute harus berupa alamat email yang valid.',
    'unique' => ':attribute sudah dipakai.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'integer' => ':attribute harus berupa bilangan bulat.',
    'numeric' => ':attribute harus berupa angka.',
    'exists' => ':attribute yang dipilih tidak valid.',
    'in' => ':attribute yang dipilih tidak valid.',
    'image' => ':attribute harus berupa gambar.',
    'mimes' => ':attribute harus berformat: :values.',
    'min' => [
        'numeric' => ':attribute minimal :min.',
        'string' => ':attribute minimal :min karakter.',
    ],
    'max' => [
        'numeric' => ':attribute maksimal :max.',
        'string' => ':attribute maksimal :max karakter.',
        'file' => ':attribute maksimal :max kilobyte.',
    ],
    'password' => [
        'min' => ':attribute minimal :min karakter.',
    ],

    'attributes' => [
        'name' => 'nama',
        'email' => 'email',
        'password' => 'password',
        'category_id' => 'kategori',
        'description' => 'deskripsi',
        'price' => 'harga',
        'stock' => 'stok',
        'image' => 'gambar',
        'qty' => 'jumlah',
        'role' => 'role',
        'status' => 'status',
    ],
];
