<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class inputDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        // return new FreeResource($this->categorychildren->only)
        return parent::toArray($request);

    }
}
