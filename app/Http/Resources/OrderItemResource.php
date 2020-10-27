<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'order_item_id' => $this->id,
            'product_name' => isset($this->product->name) ? $this->product->name : null,
            'product_image' => isset($this->product->main_image) ? $this->product->main_image : null,
            'size' => $this->size,
            'color' => $this->color,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'mrp' => $this->mrp,
            'discount_percent' => $this->discount,
            'order_status' => $this->order_status,
            'refund_request' => $this->refund_request,
            'refund_amount' => $this->refund_amount,
        ];
    }
}
