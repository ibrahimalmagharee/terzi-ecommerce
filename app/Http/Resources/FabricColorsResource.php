<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FabricColorsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'fabric_id' => $this->fabric_id,
            'color_id' => $this->color_id,
        ];
    }
}
