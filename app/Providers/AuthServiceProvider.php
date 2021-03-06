<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate way for different user BEGIN
        
        Gate::define('isAdmin', function($user){
            return $user->type === 'admin';
        });

        Gate::define('isUser', function($user){
            return $user->type === 'user';
        });

        Gate::define('isAuthor', function($user){
            return $user->type === 'author';
        });
        
        // Gate way for different user END 


         if (! $this->app->routesAreCached()) {
            Passport::routes();
        }
    }
}
