<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;

class ProductController extends Controller
{

    private $repository;

    public function __construct(Product $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->latest()->paginate(10);



        return view("admin.pages.products.index", compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view("admin.pages.products.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProduct $request)
    {
        $data = $request->all();

        $tenant = auth()->user()->tenant;


        ///////////////////////////////////////////////////////////////////////////////////////////////
        //Verifica se a imagem é valida caso seja, armazenará dentro de storage/tenant/uuid?/products//
        ///////////////////////////////////////////////////////////////////////////////////////////////
        if ($request->hasFile('image') && $request->image->isValid()) {
            //$request->image->getClientOriginalName();
            $data['image'] = $request->image->store("public/tenants/{$tenant->uuid}/products");

            $urlGerada = explode("/", $data['image']);
            $data['image'] = "storage/tenants/" . $urlGerada[2] . "/products/" . $urlGerada[4];
        }


        //dd($data);
        $this->repository->create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }



        return view("admin.pages.products.show", compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view("admin.pages.products.edit", compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProduct $request, $id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        $tenant = auth()->user()->tenant;

        /////////////////////////////////////////////////////////////////////////
        //Verifica se a imagem é valida caso seja, armazenará dentro de storage//
        /////////////////////////////////////////////////////////////////////////        
        if ($request->hasFile('image') && $request->image->isValid()) {
            //$request->image->getClientOriginalName();
            $data['image'] = $request->image->store("public/tenants/{$tenant->uuid}/products");

            $urlGerada = explode("/", $data['image']);
            $data['image'] = "storage/tenants/" . $urlGerada[2] . "/products/" . $urlGerada[4];
        }

        $product->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        $product->delete();

        return redirect()->route('products.index');
    }

    public function search(Request $request)
    {

        $filters = $request->only("filter");

        $products = $this->repository->where(function ($query) use ($request) {
            if ($request->filter) {
                $query->orWhere('description', 'LIKE', "%{$request->filter}%");
                $query->orWhere('name', $request->filter);
            }
        })
            ->latest()
            ->paginate(2);

        return view('admin.pages.products.index', compact('products', 'filters'));
    }
}
