<?php

namespace App\Models;

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
}
