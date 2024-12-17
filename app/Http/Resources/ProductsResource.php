<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return
        [
            'name' => $this->name,
            'price' => number_format($this->price, 2),
            'quantity' => $this->quantity,
            'category' => $this->category->name,
            'seller' => $this->seller->name ?? null,
        ];
    }

}
