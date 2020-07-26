<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\TenantService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;

class TenantApiController extends Controller
{

    ///////////////////////////////////////////////////////////////////////////////////////////////
    //O controller se comunica com serviço, o serviço com o repository e o repository com o model//
    ///////////////////////////////////////////////////////////////////////////////////////////////

    protected $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function index()
    {
        //return $this->tenantService->getAllTenants();
        return TenantResource::collection($this->tenantService->getAllTenants());
    }

    public function show($uuid)
    {
        $tenant = $this->tenantService->getTenantByUuid($uuid);

        return new TenantResource($tenant);
    }
}
