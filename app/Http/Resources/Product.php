<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'user_id' => $this->user_id,
            'image_url' => $this->image_url,
            'product_offer' => $this->product_offer,
            'prices' => $this->prices,
            'quantity' => $this->quantity,
            'cate_id' => $this->cate_id,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'creat_up' => $this->creat_up->format('d/m/Y'),
            'update_up' => $this->update_up->format('d/m/Y')
        ];
    }
}
