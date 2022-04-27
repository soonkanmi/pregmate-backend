<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegistrationController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'user',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/profile', [UserController::class, 'profile']);

    Route::post('/update-personal-information', [UserController::class, 'updatePersonalInformation']);
    Route::post('/update-obstetrical-information', [UserController::class, 'updateObstetricalInformation']);
    Route::post('/update-medical-information', [UserController::class, 'updateMedicalInformation']);
    Route::post('/save-pregnancy-information', [UserController::class, 'savePregnancyInformation']);
    Route::post('/record-vitals', [UserController::class, 'recordVitals']);
    Route::get('/get-vitals', [UserController::class, 'getVitals']);

    Route::get('/logout', [UserController::class, 'logout']);
});

Route::group([
    'prefix' => 'user',
    'middleware' => 'guest'
], function () {
    Route::post('/register', [RegistrationController::class, 'store']);
    Route::post('/login', [LoginController::class, 'login']);
});
