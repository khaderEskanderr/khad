<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class View extends JsonResource
{

    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'value' => $this->value,
            'creat_up' => $this->creat_up->format('d/m/Y'),
            'update_up' => $this->update_up->format('d/m/Y')
        ];
    }
}
