@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="card auth-box">
    <h2>Login</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label><input type="checkbox" name="remember"> Ingat saya</label>
        <br>
        <button type="submit" class="btn">Login</button>
    </form>
    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
</div>
@endsection
