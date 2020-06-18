<?php

namespace App\Tenant\Observer;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class TenantObserver
{
    /**
     * Handle the plan "creating" event.
     *
     * @param  Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function creating(Model $model)
    {

        $managerTenant = app(ManagerTenant::class);

        $model->tenant_id = $managerTenant->getTenantIdentify();
    }
}
