<?php

namespace App\Repositories\Admin;

use App\Http\Requests\RequestInterface;
use App\Models\Product;
use App\Repositories\RepositoriesInterface;
use App\Traits\UploadFiles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductRepository implements RepositoriesInterface
{

    use UploadFiles;

    /**
     * @param mixed $request
     * @return Product $product
     */
    public function store(RequestInterface $request): Product
    {
        $gallery_url = [];
        $fields = $request->validated();

        $product = Product::create([
            'title' => $fields['title'],
            'slug'  => Str::slug($fields['title']) . random_int(10 , 999),
            'price' => $fields['price'],
            'count' => $fields['count'],
            'short_desc' => $fields['short_desc'],
            'description' => $fields['description'],
            'cat_id' => $fields['cat_id'],
            'user_id' => Auth::user()->id,
            'brand_id' => $fields['brand_id'],
            'thumbnail_url' => '',
            'gallery_url' => json_encode([]),
        ]);

        if ($product) {
            $thumbnail_url = $this->upload($fields['thumbnail_file']);
            foreach ($fields['gallery_file'] as $file) {
                $gallery_url[] = $this->upload($file);
            }
            $product->update([
                'thumbnail_url' => $thumbnail_url,
                'gallery_url' => json_encode($gallery_url)
            ]);
        }

        return $product;
    }



    public function find(RequestInterface $request): void
    {
        // TODO: Implement find() method.
    }

    public function update(RequestInterface $request): void
    {
        // TODO: Implement update() method.
    }

    public function delete(RequestInterface $request): void
    {
        // TODO: Implement delete() method.
    }
}
