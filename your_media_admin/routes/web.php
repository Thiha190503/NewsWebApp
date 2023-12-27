<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    //home
    Route::get('home',[HomeController::class,'home'])->name('admin#home');
    Route::get('home/newsDetails/{id}',[HomeController::class,'newsDetails'])->name('admin#newsDetails');

    //profile
    Route::get('dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class,'updateAdminAccount'])->name('admin#updateAdminAccount');
    Route::get('admin/profile/changePasswordPage',[ProfileController::class,'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('admin/profile/changePassword',[ProfileController::class,'changePassword'])->name('admin#changePassword');

    //admin list
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/delete/{id}',[ListController::class,'accountDelete'])->name('admin#accountDelete');
    Route::post('admin/search',[ListController::class,'accountSearch'])->name('admin#accountSearch');

    //category
    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('category/create',[CategoryController::class,'categoryCreate'])->name('admin#categoryCreate');
    Route::get('category/editPage/{id}',[CategoryController::class,'categoryEditPage'])->name('admin#categoryEditPage');
    Route::post('category/update/{id}',[CategoryController::class,'categoryUpdate'])->name('admin#categoryUpdate');
    Route::get('category/delete/{id}',[CategoryController::class,'categoryDelete'])->name('admin#categoryDelete');
    Route::post('category/search',[CategoryController::class,'categorySearch'])->name('admin#categorySearch');

    //post
    Route::get('post',[PostController::class,'index'])->name('admin#post');
    Route::post('post/create',[PostController::class,'postCreate'])->name('admin#postCreate');
    Route::get('post/postEditPage/{id}',[PostController::class,'postEditPage'])->name('admin#postEditPage');
    Route::post('post/postUpdate/{id}',[PostController::class,'postUpdate'])->name('admin#postUpdate');
    Route::get('post/postDelete/{id}',[PostController::class,'postDelete'])->name('admin#postDelete');
    Route::post('post/search',[PostController::class,'postSearch'])->name('admin#postSearch');

    //trend
    Route::get('trendPost',[TrendPostController::class,'index'])->name('admin#trendPost');
    Route::get('trendPost/details/{id}',[TrendPostController::class,'trendPostDetails'])->name('admin#trendPostDetails');
});
