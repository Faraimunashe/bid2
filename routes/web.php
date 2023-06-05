<?php

use App\Http\Controllers\ProfileController;
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
    return redirect()->route('login');
});

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['middleware' => ['auth', 'role:admin']], function(){
    Route::get('/admin/dashboard', 'App\Http\Controllers\admin\DashboardController@index')->name('admin-dashboard');
});

Route::group(['middleware' => ['auth', 'role:seller']], function(){
    Route::get('/seller/dashboard', 'App\Http\Controllers\seller\DashboardController@index')->name('seller-dashboard');
    Route::post('/seller/add-product', 'App\Http\Controllers\seller\DashboardController@add')->name('seller-add-product');
    Route::post('/seller/update-product', 'App\Http\Controllers\seller\DashboardController@update')->name('seller-update-product');
    Route::post('/seller/update-productImage', 'App\Http\Controllers\seller\DashboardController@update')->name('seller-update-productImage');
    Route::post('/seller/delete-product', 'App\Http\Controllers\seller\DashboardController@delete')->name('seller-delete-product');

    Route::get('/seller/bid', 'App\Http\Controllers\seller\bidController@index')->name('seller-bid');
    Route::post('/seller/accept-bid', 'App\Http\Controllers\seller\bidController@accept')->name('seller-accept-bid');
});

Route::group(['middleware' => ['auth', 'role:user']], function(){
    Route::get('/user/dashboard', 'App\Http\Controllers\user\DashboardController@index')->name('user-dashboard');
    Route::get('/user/add-bid', 'App\Http\Controllers\user\DashboardController@bid')->name('user-add-bid');

    Route::get('/user/bid', 'App\Http\Controllers\user\BidController@index')->name('user-bid');
    Route::get('/user/delete-bid', 'App\Http\Controllers\user\BidController@delete')->name('user-delete-bid');
});



require __DIR__.'/auth.php';
