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

    public function index(Request $request)
    {
        $per_page =  (int) $request->get('per_page', 2);

        //return $this->tenantService->getAllTenants();
        $tenants = $this->tenantService->getAllTenants($per_page);
        return TenantResource::collection($tenants);
    }

    public function show($uuid)
    {
        ////////////////////////////////////////////////////////////////////////////////        
        //Tratamento de erro caso o uuid não exista
        ////////////////////////////////////////////////////////////////////////////////
        if (!$tenant = $this->tenantService->getTenantByUuid($uuid)) {
            return response()->json(['message' => "Not Found"], 404);
        }


        return new TenantResource($tenant);
    }
}
