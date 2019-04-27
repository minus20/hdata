<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function testUsersListedCorrectly()
    {
        factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => bcrypt('testpassword123')
        ]);
        factory(User::class)->create([
            'email' => 'testlogin1@user.com',
            'password' => bcrypt('testpassword123')
        ]);

        $response = $this->json('GET','api/users')
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    "id",
                    "name",
                    "email",
                    "email_verified_at",
                    "created_at",
                    "updated_at",
                ],
            ]);
        $this->assertEquals(false, isset($response->getContent()[0]['api_token']));
    }
}
