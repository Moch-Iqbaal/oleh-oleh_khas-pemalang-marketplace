@extends('layouts.admin')
@section('title', 'Kelola User')
@section('content')
<h1 class="text-3xl font-extrabold tracking-tight">Kelola user</h1>
<form method="GET" class="mt-6 flex gap-3">
    <input type="search" name="q" value="{{ $search }}" placeholder="Cari nama atau email" class="w-64 rounded-xl px-4 py-2 text-sm ring-1 ring-stone-200 focus:ring-2 focus:ring-orange-400">
    <button class="rounded-xl bg-stone-900 px-4 py-2 text-sm font-semibold text-white">Cari</button>
</form>
<div class="mt-6 overflow-x-auto rounded-2xl bg-white shadow-sm ring-1 ring-stone-200/70">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 text-left text-xs uppercase tracking-wide text-stone-500">
            <tr><th class="px-5 py-3">Nama</th><th class="px-5 py-3">Email</th><th class="px-5 py-3">Role</th><th class="px-5 py-3">Ubah role</th></tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @foreach ($users as $user)
                <tr class="hover:bg-stone-50">
                    <td class="px-5 py-3 font-semibold">{{ $user->name }}</td>
                    <td class="px-5 py-3">{{ $user->email }}</td>
                    <td class="px-5 py-3"><span class="rounded-full bg-stone-100 px-2.5 py-1 text-xs font-semibold capitalize">{{ $user->role }}</span></td>
                    <td class="px-5 py-3">
                        <form action="{{ route('admin.users.role', $user) }}" method="POST" class="flex gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="role" class="rounded-lg px-2 py-1.5 text-sm ring-1 ring-stone-200">
                                @foreach (['admin', 'staff', 'seller', 'customer'] as $role)
                                    <option value="{{ $role }}" @selected($user->role === $role)>{{ $role }}</option>
                                @endforeach
                            </select>
                            <button class="rounded-lg bg-stone-900 px-3 py-1.5 font-semibold text-white">Simpan</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $users->links('pagination') }}
@endsection
