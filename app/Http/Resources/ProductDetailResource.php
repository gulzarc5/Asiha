<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\ProductSizeResource;

class ProductDetailResource extends JsonResource
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
            'category_name' => isset($this->category->name) ? $this->category->name : null,
            'sub_category_name' => isset($this->subCategory->name) ? $this->subCategory->name : null,
            'last_category_name' => isset($this->thirdCategory->name) ? $this->thirdCategory->name : null,
            'brand_name' => isset($this->brand->name) ? $this->brand->name : null,
            'main_image' => $this->main_image,
            'min_price' => $this->min_price,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'size_chart' => $this->size_chart,
            'status' => $this->status,
            'sizes' => !empty($this->sizes) ? ProductSizeResource::collection($this->sizes) : [],
            'productColors' => $this->productColors,

        ];
    }
}
