<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\Api\CmdController;

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
            'price' =>CmdController::formatNumberCur( $this->price),
            'unit' => $this->unit,
            'weight' =>CmdController::formatNumberCur( $this->weight), 
            'total' => CmdController::formatNumberCur( $this->total), 
            // 'created_at' => (string)$this->created_at,
            // 'updated_at' => (string)$this->updated_at,
        ];

    }
}
