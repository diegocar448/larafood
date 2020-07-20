<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Tenant;
use App\Models\Permission;
use App\Models\Traits\UserACLTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable, UserACLTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tenant_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    ///////////////////////////////////////////////////////////
    ///////queryScoped(Global) versão 7 booted e 6 boot////////
    ///////////////////////////////////////////////////////////
    /* protected static function booted()
    {
        static::addGlobalScope('tenant', function (Builder $builder) {
            $builder->where('tenant_id', auth()->user()->tenant_id);
        });
    } */



    ///////////////////////////////////////////////////////////
    ///////queryScoped(Local) versão 7 booted e 6 boot/////////
    ///////////////////////////////////////////////////////////
    public function scopeTenantUser(Builder $query)
    {
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }





    ///////////////////////////////////////////////////////////
    ///////////////////User X Tenant///////////////////////////
    ///////////////////////////////////////////////////////////
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /////////////////////////////////////////////////////////////////////////
    ///////////////////////Relacionamento com Role //////////////////////////
    /////////////////////////////////////////////////////////////////////////
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    ///////////////////////////////////////////////////////////////////////////////
    /////Filtro para pegar somente as Roles ainda não selecionadas para o User ////
    ///////////////////////////////////////////////////////////////////////////////
    public function roleAvailable($filter = null)
    {


        $roles = Role::whereNotIn("roles.id", function ($query) {
            $query->select("role_user.role_id");
            $query->from("role_user");
            $query->whereRaw("role_user.user_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter)
                    $queryFilter->where("roles.name", "LIKE", "%{$filter}%");
            })
            //->where("role_profile_profile_id", "LIKE", $this->id)
            ->paginate(2);




        return $roles;
    }
}
