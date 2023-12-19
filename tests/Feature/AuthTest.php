<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    public function test_register()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/register', $userData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'john@test.com']);
    }

    public function test_login()
    {
        $user = User::factory()->create([
            'email' => 'john@test.com',
            'password' => bcrypt('password'),
        ]);

        $loginData = ['email' => 'john@test.com', 'password' => 'password'];
        $response = $this->postJson('/api/login', $loginData);
        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    public function test_logout()
    {
        $user = User::factory()->create();
        $token = $user->createToken('testToken')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/logout');
        $response->assertStatus(200);
    }
}
