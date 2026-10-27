@extends('layouts.admin')
@section('title', 'Kelola User')
@section('content')
<div class="card">
    <h2>Kelola User</h2>
    <form method="GET" class="row">
        <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama atau email" style="max-width:300px">
        <button class="btn">Cari</button>
    </form>
    <table>
        <tr><th>Nama</th><th>Email</th><th>Role</th><th>Ubah Role</th></tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td><span class="badge">{{ $user->role }}</span></td>
            <td>
                <form action="{{ route('admin.users.role', $user) }}" method="POST" class="row">
                    @csrf
                    @method('PATCH')
                    <select name="role" style="max-width:140px">
                        @foreach (['admin', 'staff', 'customer'] as $role)
                            <option value="{{ $role }}" @selected($user->role === $role)>{{ $role }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm">Simpan</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $users->links('pagination') }}
</div>
@endsection
