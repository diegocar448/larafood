<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    /**
     * Validation Create New Order.
     *
     * @return void
     */
    public function testValidationCreateNewOrder()
    {
        $payload = [];

        $response = $this->postJson('/api/v1/orders', $payload);



        $response->assertStatus(422)
            ->assertJsonPath('errors.uuid', [
                trans("validation.required", ["attribute" => 'uuid'])
            ])
            ->assertJsonPath('errors.products', [
                trans("validation.required", ["attribute" => 'products'])
            ]);
    }

    /**
     * Create New Order.
     *
     * @return void
     */
    public function testCreateNewOrder()
    {

        $tenant = factory(Tenant::class)->create();


        $payload = [
            'uuid' => $tenant->uuid,
            'products' => [],
        ];

        $products = factory(Product::class, 10)->create();

        //var_dump($products);

        foreach ($products as $key => $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 2,
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        //$response->dump();

        $response->assertStatus(201);
    }

    /**
     * Create Total Order.
     *
     * @return void
     */
    public function testTotalOrder()
    {

        $tenant = factory(Tenant::class)->create();


        $payload = [
            'uuid' => $tenant->uuid,
            'products' => [],
        ];

        $products = factory(Product::class, 2)->create();

        //var_dump($products);

        foreach ($products as $key => $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 2,
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->dump();

        $response->assertStatus(201)
            ->assertJsonPath('data.total', 51.6);
    }
}
