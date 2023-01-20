<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

//  thiet lap lop muc tieu cho LocaliazaController
Route::get(
    '/localization/{language}'
,
[App\Http\Controllers\LocalizationController::class,'switch']
)->name('localization.switch');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(
   [ 
    'register' =>false
   ]
);


Route::group(['prefix'=> 'dashboard', 'middleware'=>['web','auth']],function(){
    //dashbroad
    Route::get('/a', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    //categries
    Route::get('/categories/select',[\App\Http\Controllers\CategoryController::class,'select'])->name('categories.select');
    Route::resource('/categories',\App\Http\Controllers\CategoryController::class);

    // tags
    Route::resource('/tags',\App\Http\Controllers\TagController::class)->except(['show']);
    Route::get('/tags/select',[\App\Http\Controllers\TagController::class,'select'])->name('tags.select');

    //hàm  except(['show']); giúp loại bỏ một sô thành phần ra khổi đường dẫn
    // Tại sao lại loại bỏ nó vì đơn giản nó ko được sử dụng nên bỏ thôi
    //posts
    Route::resource('/posts',\App\Http\Controllers\PostController::class);

    

    Route::group(['prefix' => 'filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
