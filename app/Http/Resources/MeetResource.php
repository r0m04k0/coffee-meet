<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "date_and_time" => $this->date_and_time,
            "is_online" => $this->is_online,
            "is_done" => $this->is_done,
            "is_confirmed" => $this->is_confirmed,
            "duration" => $this->final_duration->duration,
            "user" => [
                ...$this->first_user,
                "duration" => $this->first_duration->duration,
                "date_and_time" => $this->,
                "is_online" =>
            ],
            "colleague" => $this->second_user,
        ];
    }
}
