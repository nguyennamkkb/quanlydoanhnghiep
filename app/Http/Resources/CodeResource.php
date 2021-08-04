<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Code;
use App\Http\Resources\UserResource;

class CodeResource extends JsonResource
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
            'code' => $this->code,
            'isUsed' => $this->isUsed,
            'startTime' => $this->startTime,
            'endTime' => $this->endTime,
            // 'created_at' => (string)$this->created_at,
            // 'updated_at' => (string)$this->updated_at,
            'user' => new UserResource($this->user),
            // 'enterprise' =>  $this->enterprises,
            
        ];
    }
}
