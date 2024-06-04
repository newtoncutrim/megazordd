<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Passport::routes();
        
        // // Configuration of Passport
        // Passport::hashClientSecrets();
        // Passport::tokensExpireIn(now()->addDays(15)); //Defines how long it will take for the token to expire
        // Passport::refreshTokensExpireIn(now()->addDays(30)); //If the user logs, it will take more 30 for the token to expire
        // Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
