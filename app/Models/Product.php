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
}
