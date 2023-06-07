<?php

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
    Route::prefix('login')->group(function () {
        Route::view('register', 'login.register');
        Route::view('login', 'login.login');
        Route::view('logout', 'login.logout');
    });

    Route::prefix('parent')->group(function () {
        Route::view('show', 'parent.show');
        Route::view('update', 'parent.update');
    });

    Route::prefix('student')->group(function () {
        Route::view('index', 'student.index');
        Route::view('show', 'student.show');
        Route::view('create', 'student.create');
        Route::view('update', 'student.update');
        Route::view('delete', 'student.delete');
    });
}
