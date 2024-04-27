<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class OutletResource extends JsonResource
{
    public function toArray($request)
    {
        $updated_at = Carbon::parse($this->updated_at);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'status' => $this->status,
            'updated_at' => [
                'month' => $updated_at->format('F'), // Full textual representation of a month
                'day' => $updated_at->format('d'), // Day of the month, 2 digits with leading zeros
                'year' => $updated_at->format('Y'), // A full numeric representation of a year, 4 digits
                'time' => $updated_at->format('H:i:s'), // Hours, minutes, seconds
            ]
        ];
    }
}
