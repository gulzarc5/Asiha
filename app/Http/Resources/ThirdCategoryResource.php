<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SubCategoryImageResource;

class ThirdCategoryResource extends JsonResource
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
            'sub_category_images' => SubCategoryImageResource::collection($this->subCategory->subCategoryImages),
            // 'sub_category_images' => $this->subCategory->thirdLevelCategoryImages,
        ];
    }
}
