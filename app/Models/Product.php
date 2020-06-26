<?php

namespace App\Models;

use App\Models\Category;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use TenantTrait;

    protected $fillable = [
        'title',
        'price',
        'description',
        'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    ////////////////////////////////////////////////////////////////////////
    /////Filtro para pegar somente os produtos ainda não selecionadas ////
    ////////////////////////////////////////////////////////////////////////
    public function categoriesAvailable($filter = null)
    {


        $categories = Category::whereNotIn("categories.id", function ($query) {
            $query->select("category_product.category_id");
            $query->from("category_product");
            $query->whereRaw("category_product.product_id={$this->id}");
        })
            ->where(function ($queryFilter) use ($filter) {
                if ($filter)
                    $queryFilter->where("categories.name", "LIKE", "%{$filter}%");
            })
            //->where("category_product_profile_id", "LIKE", $this->id)
            ->paginate(2);




        return $categories;
    }
}
