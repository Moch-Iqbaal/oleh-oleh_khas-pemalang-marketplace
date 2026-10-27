<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;

class TransactionPolicy
{
    // Customer hanya boleh melihat pesanannya sendiri; admin & staff boleh semua
    public function view(User $user, Transaction $transaction): bool
    {
        if ($user->isAdmin() || $user->isStaff()) {
            return true;
        }

        return $transaction->user_id === $user->id;
    }

    // Mengubah status pesanan hanya admin & staff
    public function updateStatus(User $user, Transaction $transaction): bool
    {
        return $user->isAdmin() || $user->isStaff();
    }
}
