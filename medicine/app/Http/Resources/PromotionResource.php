<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'max_users' => $this->max_users,
            'description' => $this->description,
            'discount_amount' => number_format($this->discount_amount),
            'min_amount' => number_format($this->min_amount),
            'type' => $this->type,
            'status' => $this->status,
            'starts_at' => $this->starts_at,
            'expires_at' => $this->expires_at,
        ]);
    }
}
