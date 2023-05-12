<?php

use App\Http\Controllers\LoginController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// routes/api.php
Route::controller(LoginController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');

    Route::middleware('auth:sanctum')
        ->post('logout', 'logout')->name('logout');
});

//Route::get('login/{provider}', 'SocialAuthController@redirectToProvider')->name('social.login');
//Route::get('login/{provider}/callback', 'SocialAuthController@handleProviderCallback')->name('social.callback');

