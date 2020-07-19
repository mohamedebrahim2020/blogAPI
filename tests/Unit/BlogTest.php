<?php

namespace Tests\Unit;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

//php vendor/phpunit/phpunit/phpunit  : this the command who i use to run test
class BlogTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateBlogWithoutAuthentication()
    {
        $data = [
            'title' => "test blog",
            'content' => "test content",
            'image' => "files/y3pqHMz7zQtSCjT7G3iIAs6xkeTBn5c16Ai7pFzF.jpeg",


        ];

        $response = $this->postJson('/api/store', $data);
        $response->assertStatus(401);
        $response->assertJson(['message' => "Unauthenticated."]);
        $response->assertUnauthorized();
        $this->assertGuest($guard = null);
    }

    public function testCreateBlogWithAuthentication()
    {
        $data = [
            'title' => "test2 blog",
            'content' => "test content",
            'image' => "y3pqHMz7zQtSCjT7G3iIAs6xkeTBn5c16Ai7pFzF.jpg",


        ];
        $user = User::create([
            'first_name' => 'tester',
            'second_name' => 'tester2',
            'email' => 'tester@tester.com',
            'password' => 'bcrypt(123456789M)',
            'image' => 'y3pqHMz7zQtSCjT7G3iIAs6xkeTBn5c16Ai7pFzF.jpg',
        ]);

        $this->actingAs($user, 'api');

        $this->withoutExceptionHandling();
        $response = $this->json('POST', '/api/store', $data);
        $response->assertOk();
        $this->assertAuthenticated($guard = null);
    }

    public function testGettingAllBlogs()
    {

        $user = factory(\App\User::class)->create();
        $blog = factory(\App\Blog::class)->create(['author_id' => $user->id]);
        $comment = factory(\App\Comment::class)->create(['blog_id' => $blog->id]);
        $this->withoutExceptionHandling();
        $response = $this->json('GET', '/api/showblog/' . $blog->id);
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [

                "id",
                "title",
                "content",
                "image",
                "overallRate",
                "author_id",
                "created_at",
                "updated_at",
                "comments",
            ]
        ]);
    }

    public function testCheckRegisterError()
    {

        $data = [
            'first_name' => '', //first_name required
            'second_name' => 'tester2',
            'email' => 'testers@tester.com',
            'password' => 'bcrypt(12345678M)',
            'image' => 'y3pqHMz7zQtSCjT7G3iIAs6xkeTBn5c16Ai7pFzF.png',
        ];
        $response = $this->json('POST', '/api/register', $data);
        $response->assertStatus(422);
    }
}
