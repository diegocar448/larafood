<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use Tests\TestCase;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    /**
     * Error de Get Categories by Tenant.
     *
     * @return void
     */
    public function testGetAllCategoriesTenantError()
    {
        $response = $this->getJson('/api/v1/categories');

        //$response->dump();

        $response->assertStatus(422);
    }

    /**
     * Get Categories by Tenant.
     *
     * @return void
     */
    public function testGetAllCategoriesByTenant()
    {

        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories?uuid={$tenant->uuid}");

        //$response->dump();

        $response->assertStatus(200);
    }

    /**
     * Error Get Category by Tenant.
     *
     * @return void
     */
    public function testErrorGetCategoryByTenant()
    {
        $category = 'fake_value';
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories/{$category}?uuid={$tenant->uuid}");

        //$response->dump();

        $response->assertStatus(404);
    }

    /**
     * Get Category by Tenant.
     *
     * @return void
     */
    public function testGetCategoryByTenant()
    {
        $category = factory(Category::class)->create();
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories/{$category->uuid}?uuid={$tenant->uuid}");

        //$response->dump();

        $response->assertStatus(200);
    }
}
