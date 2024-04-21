<?php


use App\Http\Controllers\FeedbackMeetController;
use App\Http\Controllers\MeetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/user', function (Request $request) {
    return $request->user();
  });

  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/get-profile-info', [ProfileController::class, 'getProfileInfo']);
  Route::post('/update-profile-info', [ProfileController::class, 'updateProfile']);
  Route::post('/change-readiness', [UserController::class, 'changeReadiness']);
  Route::get('/meet', [MeetController::class, 'getMeetInfo']);
  Route::post('/meet', [MeetController::class, 'confirmMeet']);
  Route::post('/feedback', [FeedbackMeetController::class, 'storeFeedback']);
  Route::post('/cancel', [MeetController::class, 'cancelMeet']);

});

Route::post('/upload/{user_id}', [ProfileController::class, 'uploadAvatar']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
