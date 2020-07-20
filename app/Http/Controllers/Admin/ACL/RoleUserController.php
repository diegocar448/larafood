<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleUserController extends Controller
{
    protected $user, $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
        $this->middleware(['can:users']);
    }

    public function roles($idUser)
    {
        $user = $this->user->find($idUser);



        if (!$user)
            return redirect()->back();

        $roles = $user->roles()->paginate(2);


        return view("admin.pages.users.roles.roles", compact("user", "roles"));
    }

    public function users($idRole)
    {



        if (!$role = $this->role->find($idRole))
            return redirect()->back();

        //dd($roles); 
        $users = $role->Roles()->paginate(2);




        return view("admin.pages.roles.users.users", compact("users", "role"));
    }

    public function rolesAvailable(Request $request, $idUser)
    {
        $user = $this->user->find($idUser);

        if (!$user)
            return redirect()->back();

        $filters = $request->except('_token');



        $roles = $user->roleAvailable($request->filter);



        return view("admin.pages.users.roles.available", compact("user", "roles", "filters"));
    }


    public function attachRolesUser(Request $request, $idUser)
    {


        $user = $this->user->find($idUser);

        if (!$user)
            return redirect()->back();



        if (!$request->roles || count($request->roles) === 0) {
            return redirect()->back()->with("error", "Adicione alguma permissão ao cargo");
        }


        $user->roles()->attach($request->roles);

        return redirect()->route("users.roles", $idUser);
    }

    public function detachRolesUser(Request $request, $idUser, $idRole)
    {
        $user = $this->user->find($idUser);
        $role = $this->role->find($idRole);

        if (!$user || !$role)
            return redirect()->back();


        $user->roles()->detach($role);

        return redirect()->route("users.roles", $idUser);
    }
}
