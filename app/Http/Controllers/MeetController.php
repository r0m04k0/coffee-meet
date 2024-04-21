<?php

namespace App\Http\Controllers;

use App\Http\Resources\MeetResource;
use App\Models\Duration;
use App\Models\Meet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetController extends Controller
{
    public Meet $meet;
    public function __construct(Meet $meet)
    {
        $this->meet = $meet;
    }

    /**
     * Получение информации о встрече
     *
     * @return JsonResponse
     */
    public function getMeetInfo(): JsonResponse
    {
        $meet = $this->getActiveMeet();

        if ($meet) {
            return response()->json(new MeetResource($meet));
        }
        else {
            return response()->json(null);
        }
    }

    /**
     * Получение активной встречи
     *
     * @return JsonResponse
     */
    public function getActiveMeet(): ?Meet
    {
        $user = Auth::user();
        return $this->meet->where('is_done', false)
            ->where(function (Builder $query) use ($user) {
                $query->where('user1_id', $user->id)
                    ->orWhere('user2_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->first();
    }
    public function confirmMeet(Request $request): JsonResponse
    {
        $request->validate([
            'duration'      => 'required|string',
            'date_and_time' => 'required|string',
            'is_online'     => 'required|bool',
        ]);

        $user = Auth::user();
        $meet = $this->getActiveMeet();

        if (! $meet) {
            return response()->json(null);
        }

        $duration = Duration::where('duration', $request->duration)->first();
        $date_and_time = Carbon::parse($request->date_and_time);
        $is_online = boolval($request->is_online);

        // Для первого пользователя
        if ($meet->first_user->id == $user->id) {
            $meet->update([
                  'first_duration_id' => $duration ? $duration->id : null,
                  'first_date_and_time' => $date_and_time,
                  'first_is_online' => $is_online,
                  'first_is_confirmed' => true
              ]);
            if ($meet->second_is_confirmed) {
                if (
                    $meet->first_duration_id == $meet->second_duration_id &&
                    $meet->first_date_and_time == $meet->second_date_and_time &&
                    $meet->first_is_online == $meet->second_is_online
                ) {
                    $meet->update([
                          'duration' => $duration ? $duration->id : null,
                          'date_and_time' => $date_and_time,
                          'is_online' => $is_online,
                          'is_confirmed' => true
                      ]);
                }
            }
        }
        else if ($meet->second_user->id == $user->id) {
            $meet->update([
                  'second_duration_id' => $duration ? $duration->id : null,
                  'second_date_and_time' => $date_and_time,
                  'second_is_online' => $is_online,
                  'second_is_confirmed' => true
              ]);
            if ($meet->first_is_confirmed) {
                if (
                    $meet->first_duration_id == $meet->second_duration_id &&
                    $meet->first_date_and_time == $meet->second_date_and_time &&
                    $meet->first_is_online == $meet->second_is_online
                ) {
                    $meet->update([
                          'duration' => $duration ? $duration->id : null,
                          'date_and_time' => $date_and_time,
                          'is_online' => $is_online,
                          'is_confirmed' => true
                      ]);
                }
            }
        }

        return response()->json(new MeetResource($meet));
    }
}
