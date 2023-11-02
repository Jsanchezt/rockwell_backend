<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id' => $item->getKey(),
                'created_at' => $item->created_at->toDateTimeString(),
                'name' => $item->name,
                'code' => $item->code,
                'image' => $item->image,
            ];
        })->toArray();
    }
}
