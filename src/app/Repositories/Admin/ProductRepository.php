<?php

namespace App\Repositories\Admin;

use App\Http\Requests\RequestInterface;
use App\Models\Product;
use App\Repositories\RepositoriesInterface;
use App\Traits\UploadFiles;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements RepositoriesInterface
{

    use UploadFiles;

    /**
     * @param mixed $request
     * @return Product $product
     * @throws Exception
     */
    public function store(RequestInterface $request): Product
    {
        $gallery_url = [];
        $fields = $request->validated();

        $product = Product::create($this->fieldsForCreateAndUpdate($fields));

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

    }


    public function update(RequestInterface $request , Model $product): void
    {
        $gallery_url = [];
        $fields = $request->validated();

        $product->update($this->fieldsForCreateAndUpdate($fields));

        if (Str::contains($product->thumbnail_url , $fields['thumbnail_url']->getClientOriginalName))
            $thumbnail_url = $this->upload($fields['thumbnail_file']);

        foreach (json_decode($product->gallery_url ) as $databasePhoto) {
            foreach ($fields['gallery_file'] as $file) {
                if (Str::contains($databasePhoto, $file->getClientOriginalName))
                    $gallery_url[] = $this->upload($file);
            }
        }

        $product->update([
            'thumbnail_url' => $thumbnail_url,
            'gallery_url' => json_encode($gallery_url)
        ]);
    }

    public function delete(Model $product): void
    {
        // TODO: Implement delete() method.
    }

    private function fieldsForCreateAndUpdate(array $fields , array $customData = [])
    {
        $fieldsForSave = [
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
        ];

        if ($customData) {
            foreach ($customData as $field => $value) {
                if (array_search($field, $fieldsForSave))
                    $fieldsForSave[$field] = $value;
            }
        }

        return $fieldsForSave;
    }
}
