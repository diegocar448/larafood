<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryProductController extends Controller
{
    protected $product, $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
        $this->middleware(['can:products']);
    }

    public function categories($idProduct)
    {
        if (!$product = $this->product->find($idProduct))
            return redirect()->back();

        $categories = $product->categories()->paginate(2);


        return view("admin.pages.products.categories.categories", compact("product", "categories"));
    }

    public function products($idCategory)
    {



        if (!$category = $this->category->find($idCategory))
            return redirect()->back();

        //dd($categories); 
        $products = $category->products()->paginate(2);




        return view("admin.pages.categories.products.products", compact("products", "category"));
    }

    public function categoriesAvailable(Request $request, $idProduct)
    {
        $product = $this->product->find($idProduct);

        if (!$product)
            return redirect()->back();

        $filters = $request->except('_token');



        $categories = $product->categoriesAvailable($request->filter);



        return view("admin.pages.products.categories.available", compact("product", "categories", "filters"));
    }


    public function attachCategoriesProduct(Request $request, $idProduct)
    {
        $product = $this->product->find($idProduct);



        if (!$product)
            return redirect()->back();



        if (!$request->categories || count($request->categories) === 0) {
            return redirect()->back()->with("error", "Adicione alguma(s) categoria(s) ao Produto");
        }


        $product->categories()->attach($request->categories);

        return redirect()->route("products.categories", $idProduct);
    }

    public function detachCategoriesProduct(Request $request, $idProduct, $idCategory)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);

        if (!$product || !$category)
            return redirect()->back();


        $product->categories()->detach($category);

        return redirect()->route("products.categories", $idProduct);
    }
}
