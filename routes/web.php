<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/','login');
Route::get('/login',function(){
    return Inertia::render('Login');
});

Route::group(['prefix' => '/dashboard','controller' => DashboardController::class],function(){
    Route::get('/','index');
});

Route::group(['prefix' => '/business','controller' => BusinessController::class],function(){
    Route::get('/details','details');
});
