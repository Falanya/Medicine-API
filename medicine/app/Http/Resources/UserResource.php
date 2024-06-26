<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'fullname' => $this->fullname,
            'email'=> $this->email,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'role_id' => $this->role_id == 1 ? 'Member' : 'Admin',
            'favorites' => FavoriteResource::collection($this->favorites),
        ]);
    }
}
