<?php

namespace App\Http\Controllers;

use App\Http\Resources\MeetResource;
use App\Models\Meet;
use App\Models\User;
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
            'duration'      => 'required|number',
            'date_and_time' => 'required|string',
            'is_online'     => 'required|bool',
        ]);

        $updatedData = $this->meet->update([
            'duration'      => $request->duration,
            'date_and_time' => $request->date_and_time,
            'is_online'     => $request->is_online,
        ]);

        return response()->json($updatedData);
    }
}
