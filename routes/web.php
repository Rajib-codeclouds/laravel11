<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

    Route::match(['get','post'],'login',[AdminController::class,'login']);
    // admin middleware route
    Route::group(['middleware'=>['admin']],function(){
        Route::match(['get','post'],'dashboard',[AdminController::class,'dashboard']);
        Route::match(['get','post'],'update-password',[AdminController::class,'updatePassword']);

        Route::post('/check-current-password',[AdminController::class,'checkCurrentPassword']);
        Route::match(['get','post'],'update-admin-details',[AdminController::class,'updateAdminDetails']);
        Route::get('/logout',[AdminController::class,'logout']);

        // cms page
        Route::get('cms-pages', [CmsController::class, 'index']);
        Route::post('update-cms-page-status', [CmsController::class, 'update']);
        Route::match(['get','post'],'add-edit-cms-page/{id?}',[CmsController::class,'edit']);
    });
});

