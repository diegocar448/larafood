<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $repository;

    public function __construct(Role $role)
    {
        $this->repository = $role;
        $this->middleware(['can:roles']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = $this->repository->paginate(2);


        return view('admin.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRole $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->repository->find($id);

        if (!$role)
            return redirect()->back();


        return view("admin.pages.roles.show", compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$role = $this->repository->find($id)) {
            return redirect()->back();
        }


        return view("admin.pages.roles.edit", compact("role"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRole $request, $id)
    {
        $role = $this->repository->find($id);


        if (!$role)
            return redirect()->back()->with("error", "Erro ao atualizar Cargo!");

        $role->update($request->all());

        return redirect()->route('roles.index')->with("sucesso", "Cargo atualizado com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->repository->find($id);

        if (!$role)
            return redirect()->back()->with("error", "Erro ao tentar remover Cargo");

        $role->delete();

        return redirect()->route("roles.index")->with("sucesso", "Cargo removido com sucesso");
    }


    public function search(Request $request)
    {

        $filters = $request->only("filter");

        $roles = $this->repository->where(function ($query) use ($request) {
            if ($request->filter) {
                $query->where('name', $request->filter);
                $query->orWhere('description', 'LIKE', "%{$request->filter}%");
            }
        })
            ->paginate(2);

        return view('admin.pages.roles.index', compact('roles', 'filters'));
    }
}
