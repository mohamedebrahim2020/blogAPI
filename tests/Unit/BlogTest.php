<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithoutMiddleware;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use DatabaseMigrations;


//php vendor/phpunit/phpunit/phpunit
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
    }

    public function testCreateBlogWithAuthentication()
    {
        $data = [
            'title' => "test2 blog",
            'content' => "test content",
            'image' => "files/y3pqHMz7zQtSCjT7G3iIAs6xkeTBn5c16Ai7pFzF.jpg",
            
            
                   ];
$user = User::create([
    'first_name' => '"tester"',
    'second_name' => '"tester2"',
    'email' =>'"tester@tester.com"',
    'password' => '"bcrypt(123456789)"' ,
    'image' => '"y3pqHMz7zQtSCjT7G3iIAs6xkeTBn5c16Ai7pFzF.jpg"',
    ]);
   
 
$response = $this->actingAs($user, 'api')->json('/api/store', $data);
$response->assertStatus(200);
$response->assertJson(['status' => true]);
//$response->assertJson(['message' => "Unauthenticated."]);
    }
}
