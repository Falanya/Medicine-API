<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'user_id' => $this->user_id,
            'address' => $this->address,
            'phone' => $this->phone,
            'receiver_name' => $this->receiver_name,
            'object_status' => $this->object_status == 1 ? 'Show' : 'Hidden',
        ]);
    }
}
