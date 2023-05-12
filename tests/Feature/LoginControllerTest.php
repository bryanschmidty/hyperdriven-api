<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    use WithoutMiddleware;

    public function testUserRegistration()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test.user@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'user' => [
                        'id',
                        'name',
                        'email',
                    ],
                    'token',
                ],
            ]);
    }

    public function testUserLogin()
    {
        $user = User::factory()->create();

        $loginData = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'user' => [
                        'id',
                        'name',
                        'email',
                    ],
                    'token',
                ],
            ]);
    }

    public function testUserLogout()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson('/api/logout');

        $response->assertStatus(204);
    }

//    public function testLogoutWhenNotLoggedIn()
//    {
//        $response = $this->post('/api/logout');
//
//        $response->assertStatus(401);
//    }
}
