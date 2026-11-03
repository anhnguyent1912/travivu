<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\AboutController;
use App\Http\Controllers\client\ServiceController;
use App\Http\Controllers\client\TourController;
use App\Http\Controllers\client\BookingController;
use App\Http\Controllers\client\ContactController;
use App\Http\Controllers\client\CheckoutController;
use App\Http\Controllers\client\InforController;
use App\Http\Controllers\client\LoginController;
use App\Http\Controllers\client\Tour_detailController;
use App\Http\Controllers\client\SignupController;
use App\Http\Controllers\client\Tour_guideController;
use App\Http\Controllers\client\DestinationController;
use App\Http\Controllers\client\BlogController;
use App\Http\Controllers\client\LoginGoogleController;
use App\Http\Controllers\client\SearchController;
use App\Http\Controllers\InformationController;
// Route::get('/', function () {
//     return view('home');
// });
Route::get(uri: '/', action: [HomeController::class, 'index'])->name('home');
Route::fallback(function () {
    return response()->view('clients.errors.404', [], 404);
});
Route::get(uri: '/about', action: [AboutController::class, 'index'])->name('about');
// Route::get(uri: '/service', action: [ServiceController::class, 'index'])->name('service');
Route::get(uri: '/Tour', action: [TourController::class, 'index'])->name('Tour');
// Route::get(uri: '/booking', action: [BookingController::class, 'index'])->name('booking');  
Route::get(uri: '/contact', action: [ContactController::class, 'index'])->name('contact');  
Route::get(uri: '/checkout', action: [CheckoutController::class, 'index'])->name('checkout');
Route::get(uri: '/infor', action: [InforController::class, 'index'])->name('infor');
Route::get(uri: '/search', action: [SearchController::class, 'index'])->name('search');

//login, register, logout
Route::get('/login', [LoginController::class, 'index'])
    ->name('login');
Route::post('/register', [LoginController::class, 'register'])
    ->middleware('throttle:5,1,register')
    ->name('register');
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:10,1,login')
    ->name('login.submit');
Route::get('/activate-account/{token}',[LoginController::class, 'activateAccount'])
    ->name('activate.account');
Route::post('/activation/resend',[LoginController::class, 'resendActivation'])
    ->middleware('throttle:3,1,activation.resend')
    ->name('activation.resend');
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
Route::get('auth/google', [LoginGoogleController::class, 'redirectToGoogle'])->name('login-google');
Route::get('auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback']);
//

Route::get(uri: '/tour-detail/{id?}', action: [Tour_detailController::class, 'index'])->name('tour-detail');
Route::get(uri: '/signup', action: [SignupController::class, 'index'])->name('signup');
Route::get(uri: '/destination', action: [DestinationController::class, 'index'])->name('destination');
Route::get(uri: '/blog', action: [BlogController::class, 'index'])->name('blog');
//user
Route::get('/user-profile', [InformationController::class, 'index']) ->middleware('auth') ->name('user-profile');
Route::patch('/user-profile', [InformationController::class, 'update'])->middleware('auth')->name('user-profile.update');
Route::patch('/user-profile/password', [InformationController::class, 'updatePassword']) ->middleware(['auth', 'throttle:5,1']) ->name('user-profile.password');
