<?php

use App\Models\Category;
use App\Models\Clothes;
use App\Models\Home;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClothesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardClothesController;

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

Route::get('/', function () {

    return view('home', [
        'title' => 'Home',
        "active" => "home",
        "clothes" => Clothes::latest()->take(4)->get(),
        'categories' => Category::take(3)->get(),
        'home' =>  Home::first()


    ]);
});

Route::get('clothes/', [ClothesController::class, 'index']);

Route::get('clothes/{clothes:slug}', [ClothesController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Categories',
        "active" => "categories",
        'categories' => Category::all()
    ]);
});
// Route::get('/about', function () {
//     return view('about', [
//         'title' => 'About',
//         "active" => "about",
//         'name' => 'Muhammad Al Syam',
//         'email' =>  'malsyam69@gmail.com',
//         'image' => 'Penguins.jpg'
//     ]);
// });


// PROFILE
Route::get('/profile', [UserController::class, 'index'])->middleware('auth');
Route::post('/profile/{user}', [UserController::class, 'updateUser'])->name('users.update')->middleware('auth');
// halam purchase
Route::get('profile/purchase', [UserController::class, 'purchase'])->middleware('auth');
Route::get('profile/purchase/{user}', [UserController::class, 'showPurchase'])->middleware('auth');
// halaman address
Route::get('profile/address', [UserController::class, 'address'])->middleware('auth');
Route::get('profile/address/{user}', [UserController::class, 'editAddress'])->middleware('auth');
Route::post('/profile/address/{user}', [UserController::class, 'updateAddress'])->name('address.update')->middleware('auth');





Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/city', [RegisterController::class, 'city']);


Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('admin');



Route::get('dashboard/clothes/checkSlug', [DashboardClothesController::class, 'checkSlug'])->middleware('auth');

// route clothes
Route::resource('/dashboard/clothes', DashboardClothesController::class)->middleware('auth');


Route::resource('/booking', BookingController::class)->middleware('auth');


Route::get('/checkout', [BookingController::class, 'checkout'])->middleware('auth');
Route::get('/shipping', [BookingController::class, 'shipping'])->middleware('auth');
// payment midtrans
Route::get('/payment', [PaymentController::class, 'payment'])->middleware('auth');
// Route::get('/dashboard/order', [OrderController::class, 'index'])->middleware('admin');
Route::post('/payment', [PaymentController::class, 'payment_post'])->middleware('auth');


Route::resource('/dashboard/categories', AdminCategoryController::class)->middleware('admin')->except('show');
Route::resource('/dashboard/order', OrderController::class)->middleware('admin');
