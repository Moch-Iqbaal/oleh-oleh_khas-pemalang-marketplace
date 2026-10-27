@extends('layouts.app')
@section('title', 'Daftar')
@section('content')
<div class="card auth-box">
    <h2>Daftar Akun</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Password (min. 8 karakter)</label>
        <input type="password" name="password" id="password" required>
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label for="password_confirmation">Ulangi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <br><br>
        <button type="submit" class="btn">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</div>
@endsection
