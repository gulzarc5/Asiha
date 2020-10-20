<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AddressResource;
use App\Http\Resources\OrderItemResource;

class OrderHistoryResource extends JsonResource
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
            'discount' => $this->discount,
            'amount' => $this->amount,
            'shipping_charge' => $this->shipping_charge,
            'total_amount' => $this->total_amount,
            'payment_type' => $this->payment_type,
            'payment_status' => $this->payment_status,
            'order_status' => $this->order_status,
            'shipping_address' => new AddressResource($this->shippingAddress),
            'items' => OrderItemResource::collection($this->orderDetails),
        ];
    }
}
