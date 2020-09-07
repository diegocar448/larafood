<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Client;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * Error create new client
     *
     * @return void
     */
    public function testErrorCreateNewClient()
    {


        $payload = [
            'email' => "diegocar448@hotmail.com",
            'name' => "Diego Cardoso"
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(422);
        /* ->assertExactJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    //'password' => ['The password field is required.']
                    'password' => [trans('validation.required', 'password', ['attribute' => 'password'], 'en')]
                ]
            ]); */
    }


    /**
     * Success create new client
     *
     * @return void
     */
    public function testSuccessCreateNewClient()
    {


        $payload = [
            'email' => "diegocar448@hotmail.com",
            'name' => "Diego Cardoso",
            'password' => '123123123'
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->dump();

        $response->assertStatus(201)
            ->assertExactJson([
                'data' => [
                    'name' => $payload['name'],
                    'email' => $payload['email'],
                ]
            ]);
    }
}
