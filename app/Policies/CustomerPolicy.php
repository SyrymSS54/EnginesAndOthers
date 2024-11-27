<?php

namespace App\Policies;

use App\Models\Customer\CartModel;
use App\Models\User;

class CustomerPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return $user->role === 'customer'; 
    }

    public function update(User $user,CartModel $cartModel)
    {
        return $user->id === $cartModel->user_id;
    }

    public function customer(User $user)
    {
        return $user->role === 'customer';
    }
}
