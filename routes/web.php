<?php

use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileTypeController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RateController;
// use App\Http\Controllers\RatesController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\VehicleController;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

// Route::get('/', function () {

// });
Auth::routes(['verify' => true, 'register' => true]);
Route::get('/', [FrontController::class, 'index']);
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Route Frontend
Route::get('/file/{post_slug}', [FrontController::class, 'show']);
// Route::get('/rates', [RatesController::class, 'index']);
Route::get('/category/{category_slug}', [FrontController::class, 'category']);
Route::get('/tag/{tag_slug}', [FrontController::class, 'tag']);
Route::get('/page/{slug}', [FrontController::class, 'page']);
Route::get('tarif', [PricingController::class, 'index']);
Route::get('order', [OrderController::class, 'index']);
Route::post('order/store', [OrderController::class, 'store']);
Route::get('order/payment/{uuid}', [OrderController::class, 'payment']);
Route::post('tracking', [TrackingController::class, 'index']);

Route::get('/qrcode', function () {
    return QrCode::size(300)->generate('b66e047d-39d3-4ad0-bbe7-d4be4b30341a');
});


// Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::post('/update-profile', [HomeController::class, 'update_profile'])->name('update-profile');
Route::get('/delete-profile', [HomeController::class, 'delete_profile'])->name('delete-profile');

Route::middleware('auth')->group(function () {

    Route::get('options', [OptionController::class, 'index']);
    Route::post('options/update', [OptionController::class, 'update']);

    Route::get('file-manager', [FileController::class, 'index']);

    Route::get('roles', [RoleController::class, 'index']);
    Route::get('roles/create', [RoleController::class, 'create']);
    Route::post('roles/store', [RoleController::class, 'store']);
    Route::get('roles/show/{id}', [RoleController::class, 'show']);
    Route::get('roles/edit/{id}', [RoleController::class, 'edit']);
    Route::post('roles/update/{id}', [RoleController::class, 'update']);
    Route::delete('roles/delete/{id}', [RoleController::class, 'destroy']);

    Route::get('users', [UserController::class, 'index']);
    Route::get('users/create', [UserController::class, 'create']);
    Route::post('users/store', [UserController::class, 'store']);
    Route::get('users/edit/{id}', [UserController::class, 'edit']);
    Route::post('users/update/{id}', [UserController::class, 'update']);
    Route::get('users/banned/{id}', [UserController::class, 'banned']);
    Route::get('users/activated/{id}', [UserController::class, 'activated']);
    Route::post('users/delete/{id}', [UserController::class, 'destroy']);
    Route::get('users/courier/', [UserController::class, 'courier']);

    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/create', [PostController::class, 'create']);
    Route::post('posts/store', [PostController::class, 'store']);
    Route::get('posts/edit/{id}', [PostController::class, 'edit']);
    Route::post('posts/update/{post_id}', [PostController::class, 'update']);
    Route::delete('posts/delete/{post_id}', [PostController::class, 'destroy']);
    Route::get('posts/show/{post_id}', [PostController::class, 'show']);



    Route::get('user-posts', [PostController::class, 'user_posts']);
    Route::get('user-posts/show/{post_id}', [PostController::class, 'show']);

    Route::get('pages', [PageController::class, 'index']);
    Route::get('pages/create', [PageController::class, 'create']);
    Route::post('pages/store', [PageController::class, 'store']);
    Route::get('pages/edit/{id}', [PageController::class, 'edit']);
    Route::post('pages/update/{page_id}', [PageController::class, 'update']);
    Route::delete('pages/delete/{page_id}', [PageController::class, 'destroy']);

    Route::get('banners', [BannerController::class, 'index']);
    Route::get('banners/create', [BannerController::class, 'create']);
    Route::post('banners/store', [BannerController::class, 'store']);
    Route::get('banners/edit/{id}', [BannerController::class, 'edit']);
    Route::post('banners/update/{banner_id}', [BannerController::class, 'update']);
    Route::delete('banners/delete/{banner_id}', [BannerController::class, 'destroy']);

    Route::get('vehicles', [VehicleController::class, 'index']);
    Route::get('vehicles/create', [VehicleController::class, 'create']);
    Route::post('vehicles/store', [VehicleController::class, 'store']);
    Route::get('vehicles/edit/{id}', [VehicleController::class, 'edit']);
    Route::put('vehicles/update/{vehicle_id}', [VehicleController::class, 'update']);
    Route::delete('vehicles/delete/{vehicle_id}', [VehicleController::class, 'destroy']);

    Route::get('categories', [CategoryController::class, 'index']);
    Route::post('categories/store', [CategoryController::class, 'store']);
    Route::get('categories/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('categories/update/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/delete/{id}', [CategoryController::class, 'destroy']);

    Route::get('provinces', [ProvinceController::class, 'index']);
    Route::post('provinces/store', [ProvinceController::class, 'store']);
    Route::get('provinces/show/{id}', [ProvinceController::class, 'show']);
    Route::get('provinces/edit/{id}', [ProvinceController::class, 'edit']);
    Route::post('provinces/update/{province}', [ProvinceController::class, 'update']);
    Route::delete('provinces/delete/{id}', [ProvinceController::class, 'destroy']);

    Route::post('cities/store', [CityController::class, 'store']);

    Route::get('rates', [RateController::class, 'index']);
    Route::post('rates/store', [RateController::class, 'store']);

    Route::get('tags', [TagController::class, 'index']);
    Route::post('tags/store', [TagController::class, 'store']);
    Route::get('tags/edit/{id}', [TagController::class, 'edit']);
    Route::post('tags/update/{category}', [TagController::class, 'update']);
    Route::delete('tags/delete/{id}', [TagController::class, 'destroy']);

    Route::get('orders', [AdminOrderController::class, 'index']);
    Route::get('orders/show/{order_id}', [AdminOrderController::class, 'show']);
});
