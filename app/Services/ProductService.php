<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Str;

class ProductService
{
    private $productRepository, $tenantRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getProductsByTenantUuid(string $uuid, array $categories)
    {


        $tenant = $this->tenantRepository->getTenantByUuid($uuid);


        return $this->productRepository->getProductsByTenantId($tenant->id, $categories);
    }

    public function getProductByFlag(string $flag)
    {

        return $this->productRepository->getProductByFlag($flag);
    }
}
