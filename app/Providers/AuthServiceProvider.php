<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('canDo', function($auth, $user_id){
            return $auth->id != $user_id;
        });

        Gate::define('account_edit', function($auth, $user_id){
           return $auth->id == $user_id;
        });

        Gate::define('account_add', function($auth, $owner_id){
            return $auth->id == $owner_id;
        });

        Gate::define('account_view', function($auth, $id){
            return $auth->id == $id || $auth->associateIs($id);
        });
        //
    }
}
