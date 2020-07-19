<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description'
    ];


    ////////////////////////////////////////////////////////////////    ////////
    ///////////////////////Relacionamento com Permissions //////////////////
    ////////////////////////////////////////////////////////////////////////
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
