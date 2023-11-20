<?php

use App\Http\Controllers\api\AttributeController;
use App\Http\Controllers\Auth\EmailConfirmationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CompleteProfileController;
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

// Home
Route::view('/', 'pages.landing');

// Cards
Route::controller(CardController::class)->group(function () {
    Route::get('/cards', 'list')->name('cards');
    Route::get('/cards/{id}', 'show');
});

// API
Route::prefix('api')->group(function () {
    Route::controller(AttributeController::class)->group(function () {
        Route::get('/attributes', 'getValues');
    });
});
// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/logout', 'logout')->name('logout');
})->middleware('auth');

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
})->middleware('guest');

Route::prefix('login')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/', 'showLoginForm')->name('login');
        Route::post('/', 'authenticate');
    })->middleware('guest');

    Route::controller(EmailConfirmationController::class)->group(function () {
        Route::get('/email-confirmation', 'getPage')->name('verification.notice');
        Route::post('/email-confirmation', 'resendEmail')->middleware('throttle:2,1');
        Route::get('/email-confirmation/verify/{id}/{hash}', 'verifyEmail')->middleware('signed')->name('verification.verify');
    })->middleware('auth');
});

Route::prefix('profile')->group(function () {
    Route::controller(CompleteProfileController::class)->group(function () {
        Route::get('complete', 'getPage')->name('complete-profile');
        Route::post('complete', 'postProfile');
    });

})->middleware(['auth', 'verified']);
