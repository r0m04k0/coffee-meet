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
            "is_ready"
          )
          ->get();

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
            'name' => $request->name,
            'surname' => $request->surname,
            'patronymic' => $request->patronymic,
            'email' => $request->email,
            'position' => $request->position,
            'departament' => $request->departament,
            'about' => $request->about,
            'phone' => $request->phone,
            'telegram' => $request->telegram,
            'is_confirmed' => $request->is_confirmed,
            'is_ready' => $request->is_ready,
          ]);

        return response()->json($updatedData);
    }
}