<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Profile;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);



        if (!$profile)
            return redirect()->back();

        $permissions = $profile->permissions()->paginate(2);


        return view("admin.pages.profiles.permissions.permissions", compact("profile", "permissions"));
    }

    public function permissionsAvailable($idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if (!$profile)
            return redirect()->back();

        $permissions = $profile->permissionsAvailable();



        return view("admin.pages.profiles.permissions.available", compact("profile", "permissions"));
    }


    public function attachPermissionsProfile(Request $request, $idProfile)
    {
        $profile = $this->profile->find($idProfile);

        if (!$profile)
            return redirect()->back();



        if (!$request->permissions || count($request->permissions) === 0) {
            return redirect()->back()->with("error", "Adicione alguma permissão ao perfil");
        }


        $profile->permissions()->attach($request->permissions);

        return redirect()->route("profiles.permissions", $idProfile);
    }
}
