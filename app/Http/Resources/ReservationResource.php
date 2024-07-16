<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TableResource;
use App\Http\Resources\EventResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'table' => new TableResource($this->table),
            'event' => new EventResource($this->event),
            'reserved_by' => $this->reserved_by,
            'instagram_link' => $this->instagram_link,
        ];
    }
}
