<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'creat_up' => $this->creat_up->format('d/m/Y'),
            'update_up' => $this->update_up->format('d/m/Y')
        ];
    }
}
