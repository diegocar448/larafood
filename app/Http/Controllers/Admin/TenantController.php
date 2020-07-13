<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTenant;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{

    private $repository;

    public function __construct(Tenant $repository)
    {
        $this->repository = $repository;
        $this->middleware(['can:tenants']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = $this->repository->latest()->paginate(10);



        return view("admin.pages.tenants.index", compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view("admin.pages.tenants.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTenant $request)
    {

        $this->repository->create($request->all());

        return redirect()->route('tenants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$tenant = $this->repository->with('plan')->find($id)) {
            return redirect()->back();
        }



        return view("admin.pages.tenants.show", compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.tenants.edit", compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTenant $request, $id)
    {
        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();



        /////////////////////////////////////////////////////////////////////////
        //Verifica se a imagem é valida caso seja, armazenará dentro de storage//
        /////////////////////////////////////////////////////////////////////////        
        if ($request->hasFile('logo') && $request->logo->isValid()) {
            /* if (storage_path("app/public/" . $tenant->logo)) {
                unlink("storage/" . $tenant->logo);
            } */
            $data['logo'] = $request->logo->store("public/tenants/{$tenant->uuid}/tenants");

            $urlGerada = explode("/", $data['logo']);
            $data['logo'] = "tenants/" . $urlGerada[2] . "/tenants/" . $urlGerada[4];
        }

        $tenant->update($data);

        return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$tenant = $this->repository->find($id)) {
            return redirect()->back();
        }

        if (storage_path("app/public/" . $tenant->logo)) {
            unlink("storage/" . $tenant->logo);
        }

        $tenant->delete();

        return redirect()->route('tenants.index');
    }

    public function search(Request $request)
    {

        $filters = $request->only("filter");

        $tenants = $this->repository->where(function ($query) use ($request) {
            if ($request->filter) {
                $query->orWhere('name', $request->filter);
            }
        })
            ->latest()
            ->paginate(2);

        return view('admin.pages.tenants.index', compact('tenants', 'filters'));
    }
}
