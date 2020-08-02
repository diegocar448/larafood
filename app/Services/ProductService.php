<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Str;

class ProductService
{
    private $productService, $tenantRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, ProductRepositoryInterface $productService)
    {
        $this->productService = $productService;
        $this->tenantRepository = $tenantRepository;
    }

    public function getProductsByTenantUuid(string $uuid)
    {


        $tenant = $this->tenantRepository->getTenantByUuid($uuid);


        return $this->productService->getProductsByTenantId($tenant->id);
    }

    /* public function getTableByIdentify(string $identify)
    {

        return $this->table->getTableByIdentify($identify);
    } */
}
