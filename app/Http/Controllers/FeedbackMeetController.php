<?php

namespace App\Http\Controllers;

use App\Models\FeedbackMeet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackMeetController extends Controller
{
    /**
     * Обновление данных профиля
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function storeFeedback(Request $request, FeedbackMeet $feedback, MeetController $meetController): JsonResponse
    {
        $request->validate([
           'review' => 'required|string',
           'rating' => 'required|integer|min:1|max:5',
       ]);

        $user = Auth::user();
        $meet = $meetController->getActiveMeet();

        $feedback = $feedback->create($request->only([
             'review',
             'rating'
        ]));

        if ($meet->first_user->id == $user->id) {
            $meet->update([
                  'first_feedback_meet_id' => $feedback->id,
              ]);
        }
        else if ($meet->second_user->id == $user->id) {
            $meet->update([
                  'second_feedback_meet_id' => $feedback->id,
              ]);
        }

        if ($meet->first_feedback_meet_id && $meet->second_feedback_meet_id) {
            $meet->update([
                  'is_done' => true,
                  'is_archive' => true
              ]);
        }

        return response()->json('ok');
    }
}
