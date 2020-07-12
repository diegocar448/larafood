<?php

namespace App\Providers;

use App\Models\{
    User,
    Product,
    Permission
};

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = Permission::all();

        //////////////////////////////////////////////////////////////
        ////Definir os Gates ( Verificando todas as permissões )//////
        //////////////////////////////////////////////////////////////
        foreach ($permissions as $permission) {
            Gate::define($permission->name, function (User $user) use ($permission) {
                return $user->hasPermission($permission->name);
            });
        }



        Gate::define("owner", function (User $user, Product $object) {
            return $user->id === $object->user_id;
        });

        /////////////////////////////////////////////////////////////////////
        //Gate before para ele verificar antes se o usuario é admin ou não///
        /////////////////////////////////////////////////////////////////////
        Gate::before(function (User $user) {
            if ($user->isAdmin()) {
                return true;
            }
        });
    }
}
