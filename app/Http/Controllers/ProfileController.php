<?php 

namespace App\Http\Controllers;

use App\Models\User;
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

        return response()->json(['data' => $profileData]);
  }
}