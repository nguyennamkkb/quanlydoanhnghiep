<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\inputDetailResource;

class InputResource extends JsonResource
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
            'id' => $this->id,
            'date' => $this->date,
            'customer' =>  new FreeResource ($this->customer->only('name')),
            'importer_id' => new FreeResource($this->importer->only('name')),
            'carrier_id' =>new FreeResource($this->carrier->only('name')),
            'totalmoney' => $this->totalmoney,
            'note' => $this->note,
            'item' =>  inputDetailResource::collection($this->inputdetail),
            
        ];
    }
}
