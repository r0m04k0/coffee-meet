<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    /**
     * Поменять готовность
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function changeReadiness(Request $request): JsonResponse
    {
        $isReady = User::where('id', Auth::user()->id)->update([
            'is_ready' => $request->is_ready,
        ]);

        return response()->json($isReady);
    }
}