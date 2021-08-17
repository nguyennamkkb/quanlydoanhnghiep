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
            'category' =>  $this->category->name,
            'customer' =>  $this->customer->name,
            'importer' => $this->importer->name,
            'carrier' => $this->carrier->name,
            'totalmoney' => (string)$this->totalmoney,
            'note' => $this->note,
            'prepay' =>(string) $this->prepay,
            'status' => $this->status,
            'item' =>  inputDetailResource::collection($this->inputdetail),
            
        ];
    }
}
