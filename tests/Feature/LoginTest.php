<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{

    public function testRequiresLoginAndPassword()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                'errors' => [
                    'login' ,
                    'password',
                ]
            ]);
    }

    public function testUserLoginsSuccessfuly()
    {
        $user = factory(User::class)->create([
            'login' => 'testlogin',
            'password' => bcrypt('testpassword123')
        ]);

        $payload = [
            'login' => 'testlogin',
            'password' => 'testpassword123'
        ];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
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
}
