<?php

namespace Tests\Feature;

use App\Events\ReduceProductToLimit;
use App\Listeners\SendNotifyToLimitProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMeta;
use App\Notifications\SendLimitProductNotify;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;


    public function testCreateProductWhenUserNotUnauthorized()
    {
        $category = Category::create([
            'title' => 'New Category'
        ]);

        $brand = Brand::create([
            'name' => 'New brand'
        ]);

        $this->postJson(route('products.store') , [
            'title' => 'The New Product in Laravel testing',
            'price' => 15000 ,
            'count' => 10 ,
            'short_desc' => 'The New Product in Laravel testing The New Product i n Laravel testing The New Product in Laravel testing' ,
            'description' => 'The New Product in Laravel testing The New Product in Lara The New Product in Laravel testing The New Product in Laravel testing The New Product in Laravel testing',
            'cat_id' => $category->id ,
            'brand_id' => $brand->id ,
            'thumbnail_file' => $this->uploadFile() ,
            'gallery_file' => [$this->uploadFile()],
        ], ['Accept' => 'application/json'])
            ->assertStatus(401);

    }

    public function testCreateNewProductWithTrustedFile(): void
    {
        $this->authentication();

        $category = Category::create([
            'title' => 'New Category'
        ]);

        $brand = Brand::create([
            'name' => 'New brand'
        ]);

        $response = $this->authentication()->postJson(route('products.store') , [
            'title' => 'The New Product in Laravel testing',
            'price' => 15000 ,
            'count' => 10 ,
            'short_desc' => 'The New Product in Laravel testing The New Product i n Laravel testing The New Product in Laravel testing' ,
            'description' => 'The New Product in Laravel testing The New Product in Lara The New Product in Laravel testing The New Product in Laravel testing The New Product in Laravel testing',
            'cat_id' => $category->id ,
            'brand_id' => $brand->id ,
            'thumbnail_file' => $this->uploadFile() ,
            'gallery_file' => [$this->uploadFile()],
        ], ['Accept' => 'application/json'])->assertSuccessful();

    }

    public function testCreateNewProductWithMetaData()
    {
        $this->withoutExceptionHandling();
        $category = Category::create([
            'title' => 'New Category'
        ]);

        $brand = Brand::create([
            'name' => 'New brand'
        ]);

        $response = $this->authentication()->postJson(route('products.store') , [
            'title' => 'The New Product in Laravel testing',
            'price' => 15000 ,
            'count' => 10 ,
            'short_desc' => 'The New Product in Laravel testing The New Product i n Laravel testing The New Product in Laravel testing' ,
            'description' => 'The New Product in Laravel testing The New Product in Lara The New Product in Laravel testing The New Product in Laravel testing The New Product in Laravel testing',
            'cat_id' => $category->id ,
            'brand_id' => $brand->id ,
            'thumbnail_file' => $this->uploadFile() ,
            'gallery_file' => [$this->uploadFile()],
            'width' => 12.5,
            'height' => 12 ,
            'quality' => 'NO' ,
            'receive_duration' => 5
        ], ['Accept' => 'application/json'])
            ->assertSuccessful();

        $this->assertDatabaseHas('product_metas' , [
            'width'=> 12.5 ,
            'quality' => 'NO'
        ]);
    }


    public function testAllRoleValidationInRequest(): void
    {
        $this->authentication();

        $category = Category::create([
            'title' => 'New Category'
        ]);

        $brand = Brand::create([
            'name' => 'New brand'
        ]);

        $response = $this->authentication()->postJson(route('products.store') , [
            'title' => 'testing',
            'price' => 15000 ,
            'count' => 10 ,
            'short_desc' => '' ,
            'description' => 't in Laravel testing',
            'cat_id' => '' ,
            'brand_id' => '' ,
            'thumbnail_file' =>'' ,
            'gallery_file' => '',
        ], ['Accept' => 'application/json']);

        $this->assertDatabaseMissing('products' , ['testing']);

        $response->assertJsonValidationErrors([
            'thumbnail_file',
            'title',
            'short_desc',
            'description',
            'gallery_file',
            'brand_id',
            'cat_id'
        ]);
    }

    public function testSerachProductBySlug()
    {
        $product = Product::factory()->create();

        ProductMeta::factory()->create([
            'product_id' => $product->id
        ]);

        $response = $this->authentication()->getJson(route('products.show' ,[$product])
        , ['Accept' => 'application/json'])
            ->assertSuccessful();

        $this->assertSame($product->slug , $response->json('product')['slug']);
    }


    public function UploadFile()
    {
        $stub = __DIR__.'/stubs/test.png';
        $name = Str::random(8).'.png';
        $path = sys_get_temp_dir().'/'.$name;

        copy($stub, $path);

        return new UploadedFile($path, $name, 'image/png', null, true);
    }


//    public function testSendNotifyWhenProductCountGetToLimit()
//    {
//        $this->withoutExceptionHandling();
//
//        Event::fake([
//            ReduceProductToLimit::class
//        ]);
//        Event::assertDispatched(ReduceProductToLimit::class);
//    }

}
