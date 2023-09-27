<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UrlController;

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

Route::get('/registration', function () {
    return view('registration');
})->middleware('guest');

Route::post('/registration', [UserController::class, 'registration'])->name('registration');

Route::get('/login', function () {
    return view('login');
})->middleware('guest');

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('dashboard.home');
    });

    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/short', [UrlController::class, 'index']);
    Route::post('/shortend', [UrlController::class, 'shortend'])->name('shortend');

    Route::get('/v/{short_url}', [UrlController::class, 'visit'])->name('short_url.redirect');
    Route::get('delete/{id}', [UrlController::class, 'delete'])->name('short_url.delete');
});
