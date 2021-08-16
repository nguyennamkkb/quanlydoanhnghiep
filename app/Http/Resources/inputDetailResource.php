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
        
        // return new FreeResource($this->categorychildren->only);
        // return parent::toArray($request);

        return [
            'categorychildren' => $this->categorychildren->name,
            'price' => $this->price,
            'unit' => $this->unit,
            'weight' => $this->weight,
            'total' => (string)$this->total,
            'prepay' => (string) $this->prepay,
            // 'created_at' => (string)$this->created_at,
            // 'updated_at' => (string)$this->updated_at,
        ];

    }
}
