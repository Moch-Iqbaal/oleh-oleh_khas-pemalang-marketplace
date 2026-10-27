<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    // Admin/staff boleh semua produk, seller hanya produk milik tokonya sendiri
    public function update(User $user, Product $product): bool
    {
        if ($user->isPlatformStaff()) {
            return true;
        }

        return $user->isSeller() && $user->store && $product->store_id === $user->store->id;
    }

    public function delete(User $user, Product $product): bool
    {
        return $this->update($user, $product);
    }
}
