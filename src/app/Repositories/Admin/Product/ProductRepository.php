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


    public function all(string $orderBy = 'created_at') :mixed
    {
        return Product::orderByDesc($orderBy)
            ->paginate(20);
    }


    public function findBySlug(string $slug) :Product
    {
        return Product::where('slug' , $slug)
            ->where('count' , '>' , 0)
            ->with('productMeta')
            ->first();
    }


    public function store(RequestInterface $request): Product
    {
        $fields = $request->validated();

        $product = Product::create($this->fieldsForCreateAndUpdate($fields));
        # Store Meta data for Product
        $this->saveProductMetaData($fields, $product);
        # Save Products Thumbnail and Galley
        $this->storeImageUrl($product , $fields);

        return $product;
    }


    public function update(RequestInterface $request , Model $product): void
    {
        $fields = $request->validated();
        # Update fields That filled
        $product->update($this->fieldsForCreateAndUpdate($fields));
        #update Images Url
        $this->updateImagesUrl($product, $fields);
    }


    public function storeImageUrl(Model $product ,array $fields)
    {
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
    }


    protected function updateImagesUrl(Model $product ,array $fields)
    {
        if (!Str::contains($product->thumbnail_url , $fields['thumbnail_url']->getClientOriginalName))
            $thumbnail_url = $this->upload($fields['thumbnail_file']);

        foreach (json_decode($product->gallery_url ) as $databasePhoto) {
            foreach ($fields['gallery_file'] as $file) {
                if (Str::contains($databasePhoto, $file->getClientOriginalName))
                    $gallery_url[] = $this->upload($file);
            }
        }

        if ($thumbnail_url)
            $product->update(['thumbnail_url' => $thumbnail_url,]);
        if ($gallery_url)
            $product->update(['gallery_url' => json_encode($gallery_url)]);
    }

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


    private function fieldsForCreateAndUpdate(array $fields): array
    {
        return [
            'title' => $fields['title'],
            'slug'  => Str::slug($fields['title']) . random_int(10 , 999),
            'price' => $fields['price'],
            'discount_price' => $fields['discount_price'],
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
