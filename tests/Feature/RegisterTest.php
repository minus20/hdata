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
            'email' => 'john@snow.com',
            'password' => 'starksrock',
            'password_confirmation' => 'starksrock'
        ];

        $this->json('POST', 'api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);
    }

    public function testsTequiresPasswordEmailAndName()
    {
        $this->json('POST', 'api/register')
            ->assertStatus(422)
            ->assertJson([
                "message"=> "The given data was invalid.",
                "errors" => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ],
            ]);
    }

    public function testsRequirePasswordConfirmation()
    {
        $payload = [
          'name' => 'John Snow',
          'email' => 'john@snow.com',
          'password' => 'starksrock'
        ];

        $this->json('POST','api/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => ['The password confirmation does not match.'],
                ]
            ]);
    }
}
