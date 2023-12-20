<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ListCitiesByStateController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => 'auth'], static function () {
    Route::post('/login', [AuthController::class, 'control']);
    Route::post('/forgot', ForgotPasswordController::class);
    Route::post('/reset', ResetPasswordController::class);
});

Route::group(['prefix' => 'states'], static function () {
    Route::get('{uf}/cities', [ListCitiesByStateController::class, 'control']);
});

Route::group(['middleware' => 'auth:sanctum'], static function () {
    Route::group(['prefix' => 'users'], static function () {
        Route::post('/', App\Http\Controllers\UpdateUserController::class);
        Route::post('/changePassword', App\Http\Controllers\ChangePasswordController::class);
    });

    Route::group(['middleware' => 'onlyAuditorGeneral'], static function () {
        Route::group(['prefix' => 'auditor'], static function () {
            Route::get('/', App\Http\Controllers\Index\IndexAuditorController::class);
            Route::get('/{id}', App\Http\Controllers\Show\ShowAuditorController::class);
            Route::post('/', App\Http\Controllers\Create\CreateAuditorController::class);
            Route::put('/{id}', App\Http\Controllers\Update\UpdateAuditorController::class);
            Route::delete('/{id}', App\Http\Controllers\Delete\DeleteAuditorController::class);
        });
    });
});

Route::group(['prefix' => 'create'], static function () {
    Route::post('/account', [App\Http\Controllers\Create\CreateAccountController::class, 'control']);
});

Route::get('/config', [App\Http\Controllers\ConfigController::class, 'control']);
Route::post('/cpf', [App\Http\Controllers\Validate\ValidateCpfController::class, 'control']);
Route::post('/email', [App\Http\Controllers\Validate\ValidateEmailController::class, 'control']);
Route::post('/token', App\Http\Controllers\Validate\ValidateTokenController::class);
