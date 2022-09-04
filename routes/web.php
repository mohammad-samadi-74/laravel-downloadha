<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

/* base routes */
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/contact-us', [HomeController::class, 'index'])->name('contact-us');
Route::get('/angoman', [HomeController::class, 'index'])->name('angoman');
Route::get('/tablighat', [HomeController::class, 'index'])->name('tablighat');
Route::get('/post/{post}', [HomeController::class, 'singlePost'])->name('singlePost');
Route::get('/changeSoftSlider', [HomeController::class, 'changeSoftSlider']);
Route::get('/changeLastSofts', [HomeController::class, 'changeLastSofts']);
Route::get('/searchPostsByDate', [HomeController::class, 'searchPostsByDate']);

/* like|dislike post */
Route::post('/likePost', [HomeController::class, 'likePost']);
Route::post('/dislikePost', [HomeController::class, 'dislikePost']);

/* like|dislike product */
Route::post('/likeProduct', [StoreController::class, 'likeProduct']);
Route::post('/dislikeProduct', [StoreController::class, 'dislikeProduct']);

/* auth */
Route::prefix('auth')->group(function () {
    Route::get('token', [LoginController::class, 'two_factor_auth_token'])->name('two_factor_auth_token');
    Route::post('token', [LoginController::class, 'two_factor_auth_confirm']);
    //google
    Route::get('google', [GoogleController::class, 'googleLogin'])->name('auth-google');
    Route::get('google/callback', [GoogleController::class, 'googleLoginCallback']);
});

// profile
Route::prefix('profile')->middleware('auth')->middleware('verified')->group(function () {
    Route::get('/{tab?}', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/user/edit', [ProfileController::class, 'editProfile'])->name('editProfile');
    Route::post('/user/update', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/user/two-factor-auth', [ProfileController::class, 'active_two_factor_auth'])->name('active_two_factor_auth');
    Route::get('/user/two-factor-auth', [ProfileController::class, 'two_factor_auth_form'])->name('active_two_factor_form');
    Route::post('/two-factor-auth/confirm', [ProfileController::class, 'ConfirmTwoFactorAuth'])->name('confirm-two-factor-auth');
});

// store
Route::prefix('store')->group(function () {
    Route::get('/', [StoreController::class, 'index'])->name('store');
    Route::get('{product}/product', [StoreController::class, 'singleProduct'])->name('singleProduct');
});

// cart
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'show'])->name('cart');
    Route::get('empty', [CartController::class, 'empty'])->name('emptyCart');
    Route::post('add/{product}/product', [CartController::class, 'addToCart'])->name('addToCart');
    Route::patch('{product}/changeQuantity', [CartController::class, 'changeQuantity'])->name('changeQuantity');
    Route::delete('{product}/delete', [CartController::class, 'delete'])->name('deleteCartItem');
});


//order
Route::prefix('order')->group(function () {
    Route::get('create', [OrderController::class, 'create'])->name('createOrder');
    Route::get('{order}/details', [OrderController::class, 'orderDetails'])->name('orderDetails');
    Route::get('{order}/cancel', [OrderController::class, 'cancelOrder'])->name('cancelOrder');
    Route::get('{order}/info', [OrderController::class, 'orderInfo'])->name('orderInfo');
    Route::post('{order}/payment', [OrderController::class, 'payment'])->name('payment');
});


//payping
Route::get('payment/payping', [PaymentController::class, 'payping'])->name('payping');
Route::get('payment/payping/callback', [PaymentController::class, 'paypingCallback'])->name('paypingCallback');


//addresses
Route::resource('/address', AddressController::class)->only(['create', 'store']);
Route::post('/address/getcities', [AddressController::class, 'getCities'])->name('getCities');

Route::get('/a', function () {
    auth()->user()->notify(new \App\Notifications\ActiveCodeSmsNotification("code"));
});
