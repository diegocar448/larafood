<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * Erro Test Validation Auth.
     *
     * @return void
     */
    public function testValidationAuth()
    {
        $response = $this->postJson('/api/auth/token');

        $response->assertStatus(422);
    }

    /**
     * Test Auth with user fake.
     *
     * @return void
     */
    public function testAuthClientFake()
    {
        $payload = [
            'email' => 'fake@fake.com',
            'password' => 'fake',
            'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(404)
            ->assertExactJson([
                'message' => trans("messages.invalid_credentials")
            ]);
    }


    /**
     * Test Auth Success.
     *
     * @return void
     */
    public function testAuthSuccess()
    {
        $client = factory(Client::class)->create();

        $payload = [
            'email' => $client->email,
            'password' => 'password',
            'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->dump();

        $response->assertStatus(200)
            ->assertJsonScructure(['token']);
        /* ->assertExactJson([
                'message' => trans("messages.invalid_credentials")
            ]); */
    }
}
