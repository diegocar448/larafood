<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;


class UserController extends Controller
{
    protected $repository;

    public function __construct(User $users)
    {
        $this->repository = $users;
        $this->middleware(['can:users']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->repository->latest()->tenantUser()->paginate(2);


        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    {
        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']);

        $this->repository->create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->tenantUser()->find($id);

        if (!$user)
            return redirect()->back();


        return view("admin.pages.users.show", compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$user = $this->repository->tenantUser()->find($id)) {
            return redirect()->back();
        }


        return view("admin.pages.users.edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUser $request, $id)
    {

        $profile = $this->repository->find($id);

        $data = $request->only(['name', 'email']);
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        if (!$profile)
            return redirect()->back()->with("error", "Erro ao atualizar Usuário!");

        $profile->update($data);

        return redirect()->route('users.index')->with("sucesso", "Usuário atualizado com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = $this->repository->find($id);

        if (!$profile)
            return redirect()->back()->with("error", "Erro ao tentar remover Usuário");

        $profile->delete();

        return redirect()->route("users.index")->with("sucesso", "Usuário removido com sucesso");
    }


    public function search(Request $request)
    {

        $filters = $request->only("filter");

        $users = $this->repository->where(function ($query) use ($request) {
            if ($request->filter) {
                $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                $query->orWhere('email', $request->filter);
            }
        })
            ->latest()
            ->tenantUser()
            ->paginate(2);

        return view('admin.pages.users.index', compact('users', 'filters'));
    }
}
