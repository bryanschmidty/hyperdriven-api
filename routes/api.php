<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
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

Route::controller(LoginController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');

    Route::middleware('auth:sanctum')
        ->get('whoami', 'whoami');
    Route::middleware('auth:sanctum')
        ->post('logout', 'logout')->name('logout');

});

//Route::get('login/{provider}', 'SocialAuthController@redirectToProvider')->name('social.login');
//Route::get('login/{provider}/callback', 'SocialAuthController@handleProviderCallback')->name('social.callback');

# Parents routes
Route::prefix('parent')->middleware('auth:sanctum')
    ->controller(ParentController::class)->group(function () {
        Route::get('/', 'show');
        Route::put('/', 'update');
    });

# Student routes
Route::prefix('parent/student')->middleware('auth:sanctum')
    ->controller(StudentController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{studentId}', 'show');
        Route::put('/{studentId}', 'update');
        Route::delete('/{studentId}', 'destroy');
    });

//# Assignment routes
//Route::prefix('parents/{parentId}/children/{studentId}/assignments')->middleware('auth:sanctum')
//    ->controller('AssignmentController')->group(function () {
//        Route::post('', 'store');
//        Route::get('{assignmentId}', 'show');
//        Route::put('{assignmentId}', 'update');
//        Route::delete('{assignmentId}', 'destroy');
//    });


if (app()->environment('local')) {
    Route::prefix('admin')->group(function () {
        Route::get('/users', function () {
            return App\Models\User::all();
        });
    });
}
