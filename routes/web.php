<?php

use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminPayoutController;
use App\Http\Controllers\admin\AdminOrderController;
use App\Http\Controllers\api\AttributeController;
use App\Http\Controllers\api\CartProductController;
use App\Http\Controllers\api\WishlistController;
use App\Http\Controllers\Auth\EmailConfirmationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CompleteProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
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

// API
Route::prefix('api')->group(function () {
    Route::controller(AttributeController::class)->group(function () {
        Route::get('/attributes', 'getValues');
    });
    Route::controller(CartProductController::class)->group(function () {
        Route::post('/cart', 'AddProductToCart');
        Route::delete('/cart', 'RemoveProductFromCart');
    });
    Route::controller(WishlistController::class)->group(function () {
        Route::post('/wishlist', 'AddProductToWishlist');
        Route::delete('/wishlist', 'RemoveProductFromWishlist');
    });
    Route::controller(SearchController::class)->group(function () {
        Route::get('/search', 'searchGetApi');
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
    Route::controller(LoginController::class)->middleware('guest')->group(function () {
        Route::get('/', 'showLoginForm')->name('login');
        Route::post('/', 'authenticate');
    });

    Route::controller(EmailConfirmationController::class)->middleware('auth')->group(function () {
        Route::get('/email-confirmation', 'getPage')->name('verification.notice');
        Route::post('/email-confirmation', 'resendEmail')->middleware('throttle:2,1');
        Route::get('/email-confirmation/verify/{id}/{hash}', 'verifyEmail')->middleware('signed')->name('verification.verify');
    });
});

Route::prefix('products')->group(function () {
    Route::controller(ProductListingController::class)->middleware(['auth', 'verified'])->group(function () {
        Route::get('/new', 'getPage')->name('productListing');
        Route::post('/new', 'addProduct');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/{id}', 'getPage')->name('product');
    });
});

Route::prefix('profile')->middleware(['auth', 'verified'])->group(function () {
    Route::controller(CompleteProfileController::class)->group(function () {
        Route::get('complete', 'getPage')->name('complete-profile');
        Route::post('complete', 'postProfile');
    });
    Route::prefix('{id}')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/', 'sellingProducts');
            Route::get('/sold', 'soldProducts');
            Route::get('/likes', 'likedProducts');
            Route::get('/history', 'historyProducts');
        });
    });
});

Route::prefix('search')->group(function () {
    Route::controller(SearchController::class)->group(function () {
        Route::get('/', 'searchGet')->name('search');
    });
});

Route::prefix('cart')->middleware(['auth', 'verified'])->group(function () {
    Route::controller(CartController::class)->group(function () {
        Route::get('/', 'getPage')->name('cart');
    });
});

Route::prefix('checkout')->middleware(['auth', 'verified'])->group(function () {
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/', 'getPage')->name('checkout');
        Route::post('/', 'postPage');

    });
});


Route::prefix('admin')->group(function () {

    Route::view('/', 'pages.admin.landing');
    Route::view('/users', 'pages.admin.users');
    Route::view('/payouts', 'pages.admin.payouts');
    Route::controller(AdminOrderController::class)->group(function () {
        Route::get('/orders', 'getPage')->name('admin.orders');
    });
    Route::controller(AdminUserController::class)->group(function () {
        Route::get('/users', 'getPage')->name('admin.users');
    });
    Route::controller(AdminPayoutController::class)->group(function () {
        Route::get('/payouts', 'getPage')->name('admin.payouts');
    });
    
});
