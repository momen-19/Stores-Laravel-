<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SearchAdminController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Web\HomeWebController;

use App\Http\Controllers\Web\RatingController;
use App\Http\Controllers\Web\StoreDetailController;
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

//===================   Admin =====================================
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::group( ['middleware' => ['auth']], function() {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('stores', StoreController::class);
    Route::get('search-admin',[SearchAdminController::class,'index'])->name('search-admin');
});




//===================   Web Site =====================================

Route::resource('home-page', HomeWebController::class);
Route::resource('stores-details', StoreDetailController::class);
Route::resource('ratings',RatingController::class);
Route::get('search',[\App\Http\Controllers\Web\SearchController::class,'index'])->name('search');


