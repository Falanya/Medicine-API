<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $status = [
            0 => 'Not verified',
            1 => 'Verified',
            2 => 'Shipping',
            3 => 'Compeleted',
            4 => 'Canceled',
        ];
        return ([
            'id' => $this->id,
            'tracking_number' => $this->tracking_number,
            'user_id' => new UsersResource($this->user_id),
            'address_id' => new AddressResource($this->address_id),
            'note' => $this->note,
            'status' => $status[$this->status] ?? '',
            'created_at' => $this->created_at,
            'products_order' => new ProductOrderResource($this->id),
        ]);
    }
}