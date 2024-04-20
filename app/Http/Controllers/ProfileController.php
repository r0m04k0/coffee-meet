<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
          )
          ->first();

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
            'email' => $request->email,
            'position' => $request->position,
            'departament' => $request->departament,
            'about' => $request->about,
            'phone' => $request->phone,
            'telegram' => $request->telegram,
            'date_birth' =>$request->date_birth,
          ]);

        return response()->json($updatedData);
    }
}