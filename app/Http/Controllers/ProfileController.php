<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Actions\SaveImageAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Информация профиля пользователя
     *
     * @return JsonResponse
     */
    public function getProfileInfo(): JsonResponse
    {
        $profileData = User::where('id', Auth::user()->id)
          ->select(
            "id",
            "name",
            "surname",
            "patronymic",
            "email",
            "position",
            "departament",
            "about",
            "phone",
            "telegram",
            "is_confirmed",
            "is_ready",
            "date_birth",
            "avatar",
          )
          ->first();

          $years = Carbon::now()->diffInYears(Carbon::parse($profileData->date_birth));

          $profileData->setAttribute('age', $years);

          return response()->json($profileData);
    }

    /**
     * Обновление данных профиля
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateProfile(Request $request): JsonResponse
    {
      $updatedData = User::where('id', Auth::user()->id)
        ->update([  
          'position' => $request->position,
          'departament' => $request->departament,
          'about' => $request->about,
          'phone' => $request->phone,
          'telegram' => $request->telegram,
          'date_birth' => Carbon::parse($request->date_birth)->addDay()->format('Y-m-d'),
        ]);

      return response()->json($updatedData);
    }

    public function uploadAvatar(int $user_id, Request $request, SaveImageAction $saveImageAction)
    {
        $user = User::find($user_id);

        $path = $saveImageAction($request);

        $user->avatar = $path;
        $user->save();
    
        return response()->json([
            'avatar' => $path,
        ]);
    }
}