<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class MetaProductResource extends JsonResource
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
            'width' => $this->with ,
            'height' => $this->height,
            'weight' => $this->weight ,
            'receive_duration' => $this->receive_duration ,
            'quality' => $this->quality ,
        ];
    }
}
