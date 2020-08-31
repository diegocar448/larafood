<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TenantTest extends TestCase
{
    /**
     * Test Get All App Tenants
     *
     * @return void
     */
    public function testGetAllTenants()
    {


        //Tenant::truncate();
        //Criar 10 Tenants
        factory(Tenant::class, 10)->create();

        $response = $this->get('/api/v1/tenants');
        //$response = $this->json('GET', '/api/v1/tenants');
        //$response = $this->getJson('/api/v1/tenants');

        //$response->dump();

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }


    //TEst Get Error Single Tenant
    public function testErrorGetTenant()
    {

        $tenant = "fake_value";

        //Tenant::truncate();
        //Criar 10 Tenants
        //factory(Tenant::class)->create();

        $response = $this->get("/api/v1/tenants/{$tenant}");
        //$response = $this->json('GET', '/api/v1/tenants');
        //$response = $this->getJson('/api/v1/tenants');

        //$response->dump();

        $response->assertStatus(404);
    }
}
