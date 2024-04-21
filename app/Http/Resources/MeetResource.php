<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
            "meet" => [
                "id" => $this->id,
                "date_and_time" => $this->date_and_time,
                "is_online" => $this->is_online,
                "is_done" => $this->is_done,
                "is_confirmed" => $this->is_confirmed,
                "duration" => $this->final_duration ? $this->final_duration->duration : null,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            "user" => $this->getUser('user'),
            "colleague" => $this->getUser('colleague'),
        ];
    }

    public function getUser(string $type)
    {
        $user = Auth::user();
        if ($type == 'user') {
            if ($user->id == $this->first_user->id) {
                return $this->getFirstUser();
            }
            return $this->getSecondUser();
        }
        if ($user->id == $this->first_user->id) {
            return $this->getSecondUser();
        }
        return $this->getFirstUser();
    }

    public function getFirstUser(): array
    {
        return [
            ...$this->first_user->toArray(),
            "duration"      => $this->first_duration->duration ?? null,
            "date_and_time" => $this->first_date_and_time,
            "is_online"     => $this->first_is_online,
            "age"           => Carbon::parse($this->first_user->birth_date)->age,
        ];
    }

    public function getSecondUser(): array
    {
        return [
            ...$this->second_user->toArray(),
            "duration"      => $this->second_duration->duration  ?? null,
            "date_and_time" => $this->second_date_and_time,
            "is_online"     => $this->second_is_online,
            "age"           => Carbon::parse($this->second_user->birth_date)->age,
        ];
    }
}
