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
        // return parent::toArray($request);
        $price = $this->product->discount > 0 && $this->product->discount < $this->product->price ? $this->product->discount : $this->product->price;
        return ([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'img' => $this->product->img,
            'quantity' => $this->quantity,
            'price' => number_format($price),
        ]);
    }
}
