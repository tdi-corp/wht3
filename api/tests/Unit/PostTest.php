<?php

namespace Tests\Unit;

use App\Models\Post;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{

    use RefreshDatabase;
    // /**
    //  * A basic test example.
    //  */
    // public function test_that_true_is_true(): void
    // {
    //     $this->assertTrue(true);
    // }

    // public function test_run_posts_can_be_created(): void
    // {
    //     Post::factory()->count(3)->create();

    //     $this->assertDatabaseCount('posts', 3);
    // } 

    public function test_wrong_route(): void
    {

        $response = $this->getJson('api/undefined');

        $response->assertStatus(404);
    }   
    
    public function test_show_route(): void
    {
        $this->seed();
        
        $response = $this->getJson('/api/post/1');

        $response
            ->assertStatus(200);          
    }

    public function test_index_route(): void
    {

        Post::factory()->count(11)->create();
        
        $response = $this->getJson('/api/post');

        $response
            ->assertStatus(200);        
    }  
    
    public function test_store_route(): void
    {
        $response = $this->postJson('/api/post', [ 
            'name' => 'Рама',
            'description' => 'Производство',
            'price' => '877',
            'url1' => 'https://test.com',                
        ]);

        $response
            ->assertStatus(200);   
    }

}
