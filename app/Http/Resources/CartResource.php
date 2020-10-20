<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductSizeResource;
use App\Http\Resources\CartProductResource;

class CartResource extends JsonResource
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
            'user_id' => $this->user_id,
            'quantity' => $this->quantity,
            'color' => $this->color,
            'size' => new ProductSizeResource($this->sizes),
            'product' => new CartProductResource($this->product),
        ];
    }
}
