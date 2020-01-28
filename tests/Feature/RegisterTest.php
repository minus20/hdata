<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testsRegistersSuccessfully()
    {
        $payload = [
            'name' => 'John Snow',
            'login' => 'johnsnow',
            'password' => 'starksrock',
            'password_confirmation' => 'starksrock'
        ];

        $this->json('POST', 'api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'login',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);
    }

    public function testsRequiresPasswordEmailAndName()
    {
        $this->json('POST', 'api/register')
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    'name',
                    'login',
                    'password',
                ],
            ]);
    }

    public function testsRequirePasswordConfirmation()
    {
        $payload = [
          'name' => 'John Snow',
          'login' => 'johnsnow',
          'password' => 'starksrock'
        ];

        $this->json('POST','api/register', $payload)
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'password',
                ]
            ]);
    }
}
