<?php

namespace App\Http\Resources;

use App\Enums\CategoryEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'parent' => Category::make($this->whenLoaded('parent')),
            'children' => Category::collection($this->whenLoaded('children')),
        ];
    }
}
