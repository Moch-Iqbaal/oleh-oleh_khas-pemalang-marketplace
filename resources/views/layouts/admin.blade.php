<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Panel UMKM Shop</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav class="top" style="background:#243447">
    <a href="{{ route('admin.dashboard') }}" class="brand">Panel UMKM Shop</a>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    @if (Route::has('admin.products.index'))
        <a href="{{ route('admin.products.index') }}">Produk</a>
        <a href="{{ route('admin.categories.index') }}">Kategori</a>
    @endif
    @if (Route::has('admin.orders.index'))
        <a href="{{ route('admin.orders.index') }}">Pesanan</a>
    @endif
    @if (auth()->user()->isAdmin())
        <a href="{{ route('admin.users.index') }}">User</a>
    @endif
    <a href="{{ route('home') }}">Lihat Toko</a>
    <form action="{{ route('logout') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="btn-link">Logout ({{ auth()->user()->name }})</button>
    </form>
</nav>
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-error">Ada input yang belum benar, cek lagi form di bawah.</div>
    @endif
    @yield('content')
</div>
</body>
</html>
