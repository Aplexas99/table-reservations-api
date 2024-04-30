<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutExerciseResource extends JsonResource
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
            'name' => $this->exercise->name,
            'description' => $this->exercise->description,
            'category' => $this->exercise->category,
            'series' => $this->series,
        ];
    }
}
