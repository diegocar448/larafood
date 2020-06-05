<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = [
        'id',
        'name',
        'description'
    ];

    ////////////////////////////////////////////////////////////////////////
    ///////////////////////Relacionamento com Permissions //////////////////
    ////////////////////////////////////////////////////////////////////////
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    ////////////////////////////////////////////////////////////////////////
    /////Filtro para pegar somente as permissões ainda não selecionadas ////
    ////////////////////////////////////////////////////////////////////////
    public function permissionsAvailable($filter = null)
    {


        $permissions = Permission::whereNotIn("id", function ($query) {
            $query->select("permission_id");
            $query->from("permission_profile");
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter)
                    $queryFilter->where("permissions.name", "LIKE", "%{$filter}%");
            })
            //->where("permission_profile_profile_id", "LIKE", $this->id)
            ->paginate(2);




        return $permissions;
    }
}
