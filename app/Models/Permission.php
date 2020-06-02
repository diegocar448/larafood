<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];


    ////////////////////////////////////////////////////////////////////////
    ///////////////////////Relacionamento com Profiles //////////////////
    ////////////////////////////////////////////////////////////////////////
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
