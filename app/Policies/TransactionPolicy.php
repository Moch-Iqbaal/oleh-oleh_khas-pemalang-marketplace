<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;

class TransactionPolicy
{
    // Lihat pesanan: admin/staff semua, seller pesanan tokonya, customer pesanannya sendiri
    public function view(User $user, Transaction $transaction): bool
    {
        if ($user->isPlatformStaff()) {
            return true;
        }

        if ($user->isSeller()) {
            return $user->store && $transaction->store_id === $user->store->id;
        }

        return $transaction->user_id === $user->id;
    }

    // Ubah status: admin/staff, atau seller pemilik toko pesanan tersebut
    public function updateStatus(User $user, Transaction $transaction): bool
    {
        if ($user->isPlatformStaff()) {
            return true;
        }

        return $user->isSeller() && $user->store && $transaction->store_id === $user->store->id;
    }
}
