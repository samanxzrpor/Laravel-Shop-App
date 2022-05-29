<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class BlogTest extends TestCase
{

    use RefreshDatabase;

    public function testShowAllBlogs()
    {
        $blogs = Blog::factory(17)->create();
        $response = $this->authentication()->getJson(route('blogs.index'));

        $response->assertSuccessful();
        $this->assertDatabaseCount( 'blogs',17);
    }

    public function testCreateBlogWhenUserNotAdmin()
    {
        $user = User::factory()->create();
        $this->actingAs($user , 'sanctum')->postJson(route('blogs.store') , [
            'title' => 'The New Product in Laravel testing',
            'body' => 'The New Product in Laravel testing The New Product in Lara The New Product in Laravel testing The New Product in Laravel testing The New Product in Laravel testing',
            'cat_ids' => []
        ], ['Accept' => 'application/json'])
            ->assertForbidden();
    }


    public function testCreateNewBlogWithTrustedData(): void
    {
        $this->withoutExceptionHandling();
        $category = Category::factory()->create();
        $response = $this->authentication()->postJson(route('blogs.store') , [
            'title' => 'The New Product in Laravel testing',
            'body'  => 'The New Product in Laravel testing The New Product in Lara The New Product in Laravel testing The New Product in Laravel testing The New Product in Laravel testing',
            'cat_ids' => [$category->id],
            ], ['Accept' => 'application/json'])
            ->assertSuccessful();

        $this->assertDatabaseHas('blogs' , ['title' => 'The New Product in Laravel testing']);
    }


    public function testAllRoleForStoreNewBlog(): void
    {
        $response = $this->authentication()->postJson(route('blogs.store') , [
            'title' => 'Te Ne',
            'body' => ['The Ne in Laravel testing'],
        ], ['Accept' => 'application/json']);

        $response->assertJsonValidationErrors([
            'title',
            'body' ,
            'cat_ids'
        ]);
    }

    public function testGetBlogBySlug()
    {
        $blog = Blog::factory()->create();
        $response = $this->authentication()->getJson(route('blogs.show' , $blog))
            ->assertSuccessful();
        $this->assertSame($blog->slug, $response->json('blog')['slug']);
    }

    public function testUserCanUpdateBlog()
    {
        $this->withoutExceptionHandling();
        $blog = Blog::factory()->create();

        $cat_id1 = Category::factory()->create()->id;
        $cat_id2 = Category::factory()->create()->id;

        $response = $this->authentication()->putJson(route('blogs.update' , $blog) ,[
            'title' => 'The Updated Product in Laravel testing',
            'body' => 'The updated product in Laravel testing The updated product in Laravel testing The updated product in Laravel testing',
            'cat_ids' => [$cat_id1 , $cat_id2]
        ])->assertSuccessful();

        $this->assertDatabaseHas('blogs' , ['title' => 'The Updated Product in Laravel testing']);
        $this->assertDatabaseHas('blog_category' , ['category_id' => $cat_id2]);
    }

}
