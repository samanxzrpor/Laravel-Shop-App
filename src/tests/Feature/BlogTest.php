<?php

namespace Tests\Feature;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{

    use RefreshDatabase;

    public function testShowAllBlogs()
    {
        $this->withoutExceptionHandling();
        $blogs = Blog::factory(17)->create();
        $response = $this->authentication()->getJson(route('blogs.index'));

        $response->assertSuccessful();
        $this->assertDatabaseCount( 'blogs',17);
    }


    public function testCreateNewBlogWithTrustedData(): void
    {
        $this->withoutExceptionHandling();
        $response = $this->authentication()->postJson(route('blogs.store') , [
            'title' => 'The New Product in Laravel testing',
            'body' => 'The New Product in Laravel testing The New Product in Lara The New Product in Laravel testing The New Product in Laravel testing The New Product in Laravel testing',
            ], ['Accept' => 'application/json'])
            ->assertSuccessful();

        $this->assertDatabaseHas('blogs' , ['title' => 'The New Product in Laravel testing']);
    }


    public function testCreateNewBlogWithoutTrustedData(): void
    {
        $response = $this->authentication()->postJson(route('blogs.store') , [
            'title' => 'Te Ne',
            'body' => 'The New Product in Laravel testing The New Product in Lara The New Product in Laravel testing The New Product in Laravel testing The New Product in Laravel testing',
        ], ['Accept' => 'application/json']);

        $response->assertJsonValidationErrors(['title']);

    }
}
