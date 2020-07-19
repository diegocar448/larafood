<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionRoleController extends Controller
{
    protected $role, $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
        $this->middleware(['can:roles']);
    }

    public function permissions($idRole)
    {
        $role = $this->role->find($idRole);



        if (!$role)
            return redirect()->back();

        $permissions = $role->permissions()->paginate(2);


        return view("admin.pages.roles.permissions.permissions", compact("role", "permissions"));
    }

    public function roles($idRole)
    {



        if (!$permission = $this->permission->find($idRole))
            return redirect()->back();

        //dd($permissions); 
        $roles = $permission->Roles()->paginate(2);




        return view("admin.pages.permissions.roles.roles", compact("Roles", "permission"));
    }

    public function permissionsAvailable(Request $request, $idRole)
    {
        $role = $this->role->find($idRole);

        if (!$role)
            return redirect()->back();

        $filters = $request->except('_token');



        $permissions = $role->permissionAvailable($request->filter);



        return view("admin.pages.roles.permissions.available", compact("role", "permissions", "filters"));
    }


    public function attachPermissionsRole(Request $request, $idRole)
    {


        $role = $this->role->find($idRole);

        if (!$role)
            return redirect()->back();



        if (!$request->permissions || count($request->permissions) === 0) {
            return redirect()->back()->with("error", "Adicione alguma permissão ao cargo");
        }


        $role->permissions()->attach($request->permissions);

        return redirect()->route("roles.permissions", $idRole);
    }

    public function detachPermissionsRole(Request $request, $idRole, $idPermission)
    {
        $role = $this->role->find($idRole);
        $permission = $this->permission->find($idRole);

        if (!$role || !$permission)
            return redirect()->back();


        $role->permissions()->detach($permission);

        return redirect()->route("roles.permissions", $idRole);
    }
}
