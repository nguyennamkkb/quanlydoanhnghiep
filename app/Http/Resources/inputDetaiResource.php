<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class inputDetaiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return [
        //     // 'id' => $this->id,
        //     // 'customer_id' => $this->customer_id,
        //     'categorychildren_id' => $this->categorychildren_id,
        //     'weight' => $this->weight,
        //     'unit' => $this->unit,
        //     'price' => $this->price,
        //     'total' => $this->total,
        //     'prepay' => $this->prepay,            
        // ];
        return parent::toArray($request);
    }
}
