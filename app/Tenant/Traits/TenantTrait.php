<?php

namespace App\Tenant\Traits;

use App\Tenant\Observer\TenantObserver;





/**
 * 
 */
trait TenantTrait
{
    ///////////////////////////////////////////////////////////
    ///Reescrever o metodo boot(laravel6) ou booted(laravel7)//
    ///////////////////////////////////////////////////////////
    protected static function booted()
    {

        /* parent::booted();
        static::observe(TenantObserver::class); */



        static::observe(TenantObserver::class);
    }
}
