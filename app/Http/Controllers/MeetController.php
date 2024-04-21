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
    /**
     * Получение информации о встрече
     *
     * @return JsonResponse
     */
    public function getMeet(): JsonResponse
    {
        $user = Auth::user();
        $meetData = Meet::where('is_done', false)
            ->where(function (Builder $query) use ($user) {
                $query->where('user1_id', $user->id)
                    ->orWhere('user2_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->first();

        if ($meetData) {
            return response()->json(new MeetResource($meetData));
        }
        else {
            return response()->json(null, 404);
        }
    }
}
