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
            'login' => 'testlogin',
            'password' => bcrypt('testpassword123')
        ]);
        factory(User::class)->create([
            'login' => 'testlogin1',
            'password' => bcrypt('testpassword123')
        ]);

        $response = $this->json('GET','api/users')
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    "id",
                    "name",
                    "login",
                    "created_at",
                    "updated_at",
                ],
            ]);
        $this->assertEquals(false, isset($response->getContent()[0]['api_token']));
    }

    public function testUserIsAdmin()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $this->assertEquals('admin', $user->role);
    }
}
