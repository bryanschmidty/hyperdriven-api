<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

if (app()->environment('local')) {
    Route::prefix('test')->group(function () {
        Route::view('', 'test.index');

        Route::prefix('login')->group(function () {
            Route::view('register', 'test.login.register');
            Route::view('login', 'test.login.login');
            Route::view('logout', 'test.login.logout');
        });

        Route::prefix('parent')->group(function () {
            Route::view('show', 'test.parent.show');
            Route::view('update', 'test.parent.update');
        });

        Route::prefix('student')->group(function () {
            Route::view('index', 'test.student.index');
            Route::view('show', 'test.student.show');
            Route::view('create', 'test.student.create');
            Route::view('update', 'test.student.update');
            Route::view('delete', 'test.student.delete');
        });
    });
}
