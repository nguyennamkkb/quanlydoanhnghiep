<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'customer' => new CustomersResource($this->customer->only('name')),
            'importer_id' => $this->importer_id,
            'carrier_id' => $this->carrier_id,
            'totalmoney' => $this->totalmoney,
            'note' => $this->note,
            // 'created_at' => (string)$this->created_at,
            // 'updated_at' => (string)$this->updated_at,
            'item' => new inputDetaiResource($this->inputdetail),
            // 'enterprise' =>  $this->enterprises,
            
        ];
    }
}
