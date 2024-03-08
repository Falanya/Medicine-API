<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ([
            'id' => $this->id,
            'name'=> $this->name,
            'object_status' => $this->object_status == 1 ? 'Show' : 'Hidden',
            'slug' => $this->slug,
        ]);
    }
}
