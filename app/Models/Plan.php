<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'url',
        'price',
        'description'
    ];

    ////////////////////////////////////////////////////////////////////////
    ////////////////////////Relacionametos//////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }


    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }


    ////////////////////////////////////////////////////////////////////////
    //////////////Filtro básico dos Planos//////////////////////////////////
    ////////////////////////////////////////////////////////////////////////
    public function search($filter = null)
    {
        $results = $this
            ->where("name", 'LIKE', "%{$filter}%")
            ->orWhere("description", 'LIKE', "%{$filter}%")
            ->paginate(2);


        return $results;
    }



    ////////////////////////////////////////////////////////////////////////
    //Filtro para pegar somente os perfis que ainda não estão selecionadas /
    ////////////////////////////////////////////////////////////////////////
    public function profilesAvailable($filter = null)
    {


        $profiles = Profile::whereNotIn("profiles.id", function ($query) {
            $query->select("plan_profile.profile_id");
            $query->from("plan_profile");
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter)
                    $queryFilter->where("profiles.name", "LIKE", "%{$filter}%");
            })
            //->where("permission_profile_profile_id", "LIKE", $this->id)
            ->paginate(2);




        return $profiles;
    }
}
