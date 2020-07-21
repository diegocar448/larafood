<?php

namespace App\Models\Traits;

use App\Models\Tenant;

trait UserACLTrait
{

    ///////////////////////////////////////////////////////////////////////////////
    //Retorna todas os cargos do Plano
    ///////////////////////////////////////////////////////////////////////////////
    public function permissions()
    {
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();

        $permissions = [];

        foreach ($permissionsRole as $permissionRole) {
            if (in_array($permissionRole, $permissionsPlan)) {
                array_push($permissions, $permissionsPlan);
            }
        }

        return $permissions;
    }

    public function permissionsPlan(): array
    {
        /* $tenant = $this->tenant()->first();
        $plan = $tenant->plan()->first(); */
        $tenant = Tenant::with('plan.profiles.permissions')->where('id', $this->tenant_id)->first();

        $plan = $tenant->plan;



        $permissions = [];
        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }


    ///////////////////////////////////////////////////////////////////////////////
    //Retorna todas as permissões do cargo do usuario
    ///////////////////////////////////////////////////////////////////////////////
    public function permissionsRole(): array
    {
        $roles = $this->roles()->with('permissions')->get();

        $permissions = [];
        foreach ($roles->permissions as $permission) {
            foreach ($permission->permissions as $permission) {
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
