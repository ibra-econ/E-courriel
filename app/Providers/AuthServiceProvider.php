<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Http\Middleware\IsAdmin;
use App\Models\Diffusion;
use App\Models\User;
use App\Models\Imputation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::define('register', function (User $user) {

                return $user->role === "admin";

            });

        Gate::define('update-imputation', function (User $user, Imputation $imputation) {
        //    dd($user->id);
            return $user->id == $imputation->user_id;
            // return $user->id == $imputation->user_id;
        });

    }
}
