<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ,
            'title' => $this->title ,
            'slug'  => $this->slug ,
            'price' => $this->price ,
            'discount_price' => $this->discount_price ,
            'count' => $this->count ,
            'short_desc' => $this->short_desc ,
            'description' => $this->description ,
            'cat_id' => $this->cat_id ,
            'user_id' => $this->user_id ,
            'brand_id' => $this->brand_id ,
            'thumbnail_url' => $this->thumbnail_url ,
            'gallery_url' => json_decode( $this->gallery_url) ,
            'meta_data' => MetaDataResource::collection($this->productsMeta),
            'tags' => TagsResource::collection($this->tags)
        ];
    }
}
