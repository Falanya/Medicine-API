<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $percent_sale = 0;
        if($this->product->discount > 0 && $this->product->discount < $this->product->price) {
            $percent_sale = floor(($this->product->price - $this->product->discount) / $this->product->price * 100);
        }
        return ([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'img' => $this->product->img,
            'price' => number_format($this->product->price),
            'discount' => number_format($this->product->discount),
            'percent_sale' => $percent_sale.'%',
            'status' => $this->product->status == 1 ? 'Show' : 'Hidden',
        ]);
    }
}
