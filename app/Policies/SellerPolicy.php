<?php

namespace App\Policies;

use App\Models\Product\ProductModel;
use App\Models\User;

class SellerPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user,ProductModel $productModel )
    {
        return $user->id === $productModel->info->seller->id;
    }

    public function create(User $user){
        return $user->role === 'seller';
    }

    public function seller(User $user)
    {
        return $user->role == 'seller';
    }
}
