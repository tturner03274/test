<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\PartsRequest' => 'App\Policies\PartsRequestPolicy',
        'App\Bid' => 'App\Policies\BidPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        // Can you create a parts request
        $gate->define('create-parts-request', function ($user) {
            if ($user->hasRole(['super-admin', 'admin', 'buyer'])) return true;
        });
    }
}
