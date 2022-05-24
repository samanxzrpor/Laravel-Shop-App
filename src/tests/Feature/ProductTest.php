<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @throws \JsonException
     */
    public function testCreateNewProductWithTrustedData(): void
    {
        $this->withoutExceptionHandling();

        $stub = __DIR__.'/stubs/test.png';
        $name = Str::random(8).'.png';
        $path = sys_get_temp_dir().'/'.$name;

        copy($stub, $path);

        $file = new UploadedFile($path, $name, 'image/png', null, true);


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
            'short_desc' => 'The New Product in Laravel testing The New Product in Laravel testing The New Product in Laravel testing' ,
            'description' => 'The New Product in Laravel testing The New Product in Lara The New Product in Laravel testing The New Product in Laravel testing The New Product in Laravel testing',
            'cat_id' => $category->id ,
            'user_id' => Auth::user()->id,
            'brand_id' => $brand->id ,
            'thumbnail_file' => $file ,
            'gallery_file' => [$file],
        ], ['Accept' => 'application/json'])->assertSuccessful();


    }
}
