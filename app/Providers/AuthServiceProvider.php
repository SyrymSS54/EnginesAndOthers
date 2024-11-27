<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Customer\CartModel;
use App\Models\Product\ProductModel;
use App\Policies\CustomerPolicy;
use App\Policies\SellerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ProductModel::class => SellerPolicy::class,
        CartModel::class => CustomerPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
