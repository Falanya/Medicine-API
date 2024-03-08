<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return parent::toArray($request);
    // }
    public function toArray(Request $request) {
        return([
            'id' => $this->id,
            'name' => $this->name,
            'type_id' => $this->type_id,
            'describe' => $this->describe,
            'info' => $this->info,
            'price' => number_format($this->price),
            'discount' => number_format($this->discount),
            'percen_sale' => floor(($this->price - $this->discount) / $this->price * 100).'%',
            'img' => $this->img,
            'status' => $this->status == 1 ? 'Show' : 'Hidden',
            'slug' => $this->slug
        ]);
    }
}
