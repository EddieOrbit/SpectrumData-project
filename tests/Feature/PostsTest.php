<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Passport\Passport;
use App\Models\User;
use App\Models\Post;

class PostsTest extends TestCase
{
    const EMAIL = 'test@mail.com';
    const POST_ID = 1;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function get_list_message()
    {
        $this->json('get', 'api/posts')
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data',
            ]);
    }

    /** @test */
    public function can_create_post()
    {
        Passport::actingAs(User::where('email', self::EMAIL)->first());

        $data = [
            'title'   => 'Post title',
            'content' => 'Post content',
        ];

        $this->json('post', 'api/posts', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data',
            ]);
    }

    /** @test */
    public function can_update_post()
    {
        Passport::actingAs(User::where('email', self::EMAIL)->first());

        $data = [
            'title'   => 'Post title upd',
            'content' => 'Post content upd',
        ];

        $this->json('put', 'api/posts/' . self::POST_ID, $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
            ]);
    }

    /** @test */
    public function can_delete_post()
    {
        Passport::actingAs(User::where('email', self::EMAIL)->first());

        $this->json('delete', 'api/posts/' . self::POST_ID)
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
            ]);
    }

}
