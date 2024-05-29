<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'location_code' => $this->location_code,
            'location_numbers' => LocationNumberResource::collection($this->whenLoaded('locationNumbers')),
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'outlet_id' => $this->outlet_id,
        ];
    }
}
