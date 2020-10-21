<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductSizeResource;
class CartProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'main_image' => $this->main_image,
            'status' => $this->status,
            'brand_name' => isset($this->brand->name) ? $this->brand->name : null,
            'sizes' => !empty($this->sizes) ? ProductSizeResource::collection($this->sizes) : [],
        ];
    }
}
