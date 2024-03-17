<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $stt = 1;
        $price = $this->product->discount > 0 && $this->product->discount < $this->product->price ? $this->product->discount : $this->product->price;
        return ([
            'STT' => $stt++,
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name_product' => $this->product->name,
            'img' => $this->product->img,
            'quantity' => $this->quantity,
            'price' => number_format($price),
            'status' => $this->status == 1? 'Show' : 'Hidden',
            'status_in_stock' => $this->product->quantity == 0 ? 'Sold out' : 'In stock',
            'message_quantity' => $this->product->quantity < $this->quantity ? 'Only has '. $this->product->quantity .' left in stock' : '',
        ]);
    }
}