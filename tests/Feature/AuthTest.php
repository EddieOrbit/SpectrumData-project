<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    
    public function register_test()
    {
        $data = [
            'name'   => 'testname',
            'email' => 'test@mail.com',
            'password' => '12345678',
        ];

        $this->json('post', 'api/register', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'token',
            ]);
    }

    /** @test */
    public function login_test()
    {
        $data = [
            'email' => 'test@mail.com',
            'password' => '12345678',
        ];

        $this->json('post', 'api/login', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'token',
            ]);
    }

    /** @test */
    public function login_with_wrong_password_test()
    {
        $data = [
            'email' => 'test@mail.com',
            'password' => '12345',
        ];

        $this->json('post', 'api/login', $data)
            ->assertStatus(401)
            ->assertJsonStructure([
                'error',
            ]);
    }

    /** @test */
    public function login_with_wrong_email_test()
    {
        $data = [
            'email' => 'test',
            'password' => '12345',
        ];

        $this->json('post', 'api/login', $data)
            ->assertStatus(401)
            ->assertJsonStructure([
                'error',
            ]);
    }
}
