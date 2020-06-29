<?php

namespace App\Models;

use App\Models\Tenant;
use App\Models\Traits\UserACLTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;


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
}
