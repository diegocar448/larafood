<?php

namespace App\Services;

use App\Models\Plan;
use App\Repositories\Contracts\TenantRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use Illuminate\Support\Str;

class TableService
{
    private $table, $tenantRepository;

    public function __construct(TenantRepositoryInterface $tenantRepository, TableRepositoryInterface $table)
    {
        $this->table = $table;
        $this->tenantRepository = $tenantRepository;
    }

    public function getTablesByUuid(string $uuid)
    {

        $tenant = $this->tenantRepository->getTenantByUuid($uuid);


        return $this->table->getTablesByTenantId($tenant->id);
    }

    public function getTableByUuid(string $uuid)
    {

        return $this->table->getTableByUuid($uuid);
    }
}
