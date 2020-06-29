<?php

namespace App\Models\Traits;

trait UserACLTrait
{

    public function permissions()
    {
        $tenant = $this->tenant()->first();
        $plan = $tenant->plan()->first();

        $permissions = [];
        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }
    ///////////////////////////////////////////////////////////////////////////////
    //Verifica se ele têm a permissão que é passada como parâmetro
    //Já especificando que o parâmetro será uma string e o retorno será booleano
    ///////////////////////////////////////////////////////////////////////////////
    public function hasPermission(string $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    ///////////////////////////////////////////////////////////////////////////////
    //Verifica se o email logado é um admin
    ///////////////////////////////////////////////////////////////////////////////
    public function isAdmin(): bool
    {

        return in_array($this->email, config('acl.admins'));
    }

    public function isTenant(): bool
    {

        return !in_array($this->email, config('acl.admins'));
    }
}
