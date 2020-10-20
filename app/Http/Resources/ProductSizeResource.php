<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSizeResource extends JsonResource
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
            'name' => isset($this->size->name) ? $this->size->name : null,
            'mrp' => $this->mrp,
            'price' => $this->price,
            'stock' => $this->stock,
        ];
    }
}
