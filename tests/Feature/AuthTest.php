<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->artisan('jwt:secret');
    }

 
    public function test_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'user' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at'
                ],
                'authorization' => [
                    'access_token',
                    'refresh_token',
                    'token_type',
                    'access_token_expires_in',
                    'refresh_token_expires_in'
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com'
        ]);
    }

   
    public function test_user_cannot_register_with_existing_email()
    {
        User::factory()->create([
            'email' => 'test@example.com'
        ]);

        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    
    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'user',
                'authorization' => [
                    'access_token',
                    'refresh_token',
                    'token_type',
                    'access_token_expires_in',
                    'refresh_token_expires_in'
                ]
            ]);
    }

   
    public function test_user_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'wrong_password'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

  
    public function test_user_can_refresh_token()
    {
        $user = User::factory()->create();
        $loginResponse = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password' 
        ]);

        $refreshToken = $loginResponse->json()['authorization']['refresh_token'];

        // Try to refresh the token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $refreshToken
        ])->postJson('/api/refresh');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'authorization' => [
                    'access_token',
                    'refresh_token',
                    'token_type',
                    'access_token_expires_in',
                    'refresh_token_expires_in'
                ]
            ]);
    }

   
    public function test_user_cannot_refresh_token_without_token()
    {
        $response = $this->postJson('/api/refresh');

        $response->assertStatus(401);
    }

    // /** @test */
    public function test_authenticated_user_can_get_their_profile()
    {
        $user = User::factory()->create();
        $loginResponse = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $token = $loginResponse->json()['authorization']['access_token'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->getJson('/api/user');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'user' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }


    public function test_user_cannot_access_profile_without_token()
    {
        $response = $this->getJson('/api/user');

        $response->assertStatus(401);
    }

 
    public function test_user_can_logout()
    {
        $user = User::factory()->create();
        $loginResponse = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $token = $loginResponse->json()['authorization']['access_token'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->postJson('/api/logout');

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Successfully logged out'
            ]);

        // Verify token no longer works
        $profileResponse = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->getJson('/api/user');

        $profileResponse->assertStatus(401);
    }

 
    public function test_registration_validation_rules()
    {
        $response = $this->postJson('/api/register', [
            'name' => '',
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'different'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

   
    public function test_login_validation_rules()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'not-an-email',
            'password' => ''
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    }
}