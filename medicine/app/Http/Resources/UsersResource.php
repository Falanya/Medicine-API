<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $stt = 1;
        return [
            'STT' => $stt ++,
            'id' => $this->id,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'role_id' => $this->role_id == 1 ? 'Member' : 'Admin',
            'status' => $this->status == 1 ? 'Active' : 'Blocked',
            'email_verify' => $this->email_verified_at != null ? 'Verifed' : null,
            'status_verify' => $this->statusVerify,
        ];
    }
}