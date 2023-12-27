<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/register',[AuthController::class,'register']);
Route::post('user/login',[AuthController::class,'login']);

//post
Route::get('posts',[PostController::class,'index']);
Route::post('posts/search',[PostController::class,'searchPosts']);
Route::get('posts/newsDetails/{id}',[PostController::class,'getNewsDetails']);

//category
Route::get('categories',[CategoryController::class,'getAllCategories']);
Route::post('categories/search',[CategoryController::class,'searchCategories']);

//action log
Route::post('posts/actionLog',[ActionLogController::class,'setActionLog']);




