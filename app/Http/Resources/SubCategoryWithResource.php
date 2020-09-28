<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\ThirdCategoryResource;
use App\Http\Resources\CategoryImageResource;

class SubCategoryWithResource extends JsonResource
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
            'image' => $this->image,
            'status' => $this->status,
            'is_sub_category' => $this->is_sub_category,
            'main_category_images' => CategoryImageResource::collection($this->category->categoryImages),
            'third_category' => ThirdCategoryResource::collection($this->thirdCategory),
        ];
    }
}
