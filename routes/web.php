<?php
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\TourController as AdminTourController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\AboutController;
use App\Http\Controllers\client\TourController;
use App\Http\Controllers\client\BookingController;
use App\Http\Controllers\client\ContactController;
use App\Http\Controllers\client\CheckoutController;
use App\Http\Controllers\client\InforController;
use App\Http\Controllers\client\LoginController;
use App\Http\Controllers\client\Tour_detailController;
use App\Http\Controllers\client\SignupController;
use App\Http\Controllers\client\DestinationController;
use App\Http\Controllers\client\BlogController;
use App\Http\Controllers\client\LoginGoogleController;
use App\Http\Controllers\client\SearchController;
use App\Http\Controllers\InformationController;
// Route::get('/', function () {
//     return view('home');
// });
//home
Route::get(uri: '/', action: [HomeController::class, 'index'])->name('home');
Route::fallback(function () {
    return response()->view('clients.errors.404', [], 404);
});
Route::get(uri: '/about', action: [AboutController::class, 'index'])->name('about');
Route::get(uri: '/Tour', action: [TourController::class, 'index'])->name('Tour');
// Route::get(uri: '/booking', action: [BookingController::class, 'index'])->name('booking');  
Route::get(uri: '/contact', action: [ContactController::class, 'index'])->name('contact');
Route::get('/checkout/{tourid}', [CheckoutController::class, 'index'])->whereNumber('tourid')->middleware('auth')->name('checkout');
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
Route::get('/activate-account/{token}', [LoginController::class, 'activateAccount'])
    ->name('activate.account');
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
Route::get('auth/google', [LoginGoogleController::class, 'redirectToGoogle'])->name('login-google');
Route::get('auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback']);
//
Route::get(uri: '/tour-detail/{id?}', action: [Tour_detailController::class, 'index'])->name('tour-detail');
Route::post('/tour-detail/{tourid}/booking', [BookingController::class, 'store'])->whereNumber('tourid')->middleware('auth')->name('booking.store');
Route::get('/booking/{bookingid}/success', [BookingController::class, 'show'])->whereNumber('bookingid')->middleware('auth')->name('booking.success');
Route::get('/booking', [BookingController::class, 'index'])->middleware('auth')->name('booking.index');
Route::patch('/booking/{bookingid}/cancel', [BookingController::class, 'cancel'])->whereNumber('bookingid')->middleware('auth')->name('booking.cancel');

Route::get(uri: '/destination', action: [DestinationController::class, 'index'])->name('destination');
Route::get(uri: '/blog', action: [BlogController::class, 'index'])->name('blog');
//user
Route::get('/user-profile', [InformationController::class, 'index'])->middleware('auth')->name('user-profile');
Route::patch('/user-profile', [InformationController::class, 'update'])->middleware('auth')->name('user-profile.update');
Route::patch('/user-profile/password', [InformationController::class, 'updatePassword'])->middleware(['auth', 'throttle:5,1'])->name('user-profile.password');
//admin
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->middleware('throttle:5,1,admin-login')->name('admin.login.submit');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth:admin')->name('admin.dashboard');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->middleware('auth:admin')->name('admin.bookings.index');

Route::patch('/admin/bookings/{bookingid}/confirm', [AdminBookingController::class, 'confirm'])->whereNumber('bookingid')->middleware('auth:admin')->name('admin.bookings.confirm');
Route::get('/admin/bookings/{bookingid}', [AdminBookingController::class, 'show'])->whereNumber('bookingid')->middleware('auth:admin')->name('admin.bookings.show');
Route::patch('/admin/bookings/{bookingid}/cancel', [AdminBookingController::class, 'cancel'])->whereNumber('bookingid')->middleware('auth:admin')->name('admin.bookings.cancel');
Route::get('/admin/tours', [AdminTourController::class, 'index'])->middleware('auth:admin')->name('admin.tours.index');

Route::patch('/admin/tours/{tourid}/availability', [AdminTourController::class, 'updateAvailability'])->whereNumber('tourid')->middleware('auth:admin')->name('admin.tours.availability');
Route::get('/admin/tours/create', [AdminTourController::class, 'create'])->middleware('auth:admin')->name('admin.tours.create');
Route::post('/admin/tours', [AdminTourController::class, 'store'])->middleware('auth:admin')->name('admin.tours.store');
Route::get('/admin/tours/{tourid}/edit', [AdminTourController::class, 'edit'])->whereNumber('tourid')->middleware('auth:admin')->name('admin.tours.edit');
Route::patch('/admin/tours/{tourid}', [AdminTourController::class, 'update'])->whereNumber('tourid')->middleware('auth:admin')->name('admin.tours.update');