<?php

namespace App\Repositories\Admin\Product;

use App\Http\Requests\RequestInterface;
use App\Models\Product;
use App\Models\ProductMeta;
use App\Traits\UploadFiles;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProductRepository implements ProductRepositoryInterface
{

    use UploadFiles;


    /**
     * @param string $orderBy
     * @return mixed
     */
    public function all(string $orderBy = 'created_at') :mixed
    {
        return Product::orderByDesc($orderBy)
            ->paginate(20);
    }


    /**
     * @param string $slug
     * @return Product
     */
    public function findBySlug(string $slug) :Product
    {
        return Product::where('slug' , $slug)
            ->where('count' , '>' , 0)
            ->with('productMeta')
            ->first();
    }


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

        # Store Meta data for Product
        $this->saveProductMetaData($fields, $product);

        # Save Products Thumbnail and Galley
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


    /**
     * @param RequestInterface $request
     * @param Model $product
     * @return void
     * @throws Exception
     */
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


    /**
     * @param array $fields
     * @param Product $product
     * @return void
     */
    private function saveProductMetaData(array $fields , Product $product): void
    {
        ProductMeta::create([
            'width' => $fields['width'] ?? null,
            'height' => $fields['height'] ?? null,
            'weight' => $fields['weight'] ?? null,
            'receive_duration' => $fields['receive_duration'] ?? null,
            'quality' => $fields['quality'] ?? null,
            'product_id' => $product->id
        ]);
    }

    /**
     * @throws Exception
     */
    private function fieldsForCreateAndUpdate(array $fields): array
    {
        return [
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
            'gallery_url' => json_encode([], JSON_THROW_ON_ERROR),
        ];
    }
}
