<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DashboardController;

Route::redirect('/','login');
Route::get('/login',function(){
    return Inertia::render('Login');
});


Route::group(['prefix' => '/dashboard','controller' => DashboardController::class],function(){
    Route::get('/','index')->name('dashboard');
});

Route::group(['prefix' => '/business','controller' => BusinessController::class, "as" => "business."] ,function(){
    Route::get('/details','details');
    Route::get('/create', 'create')->name('create');
    Route::get('/dailyUpdate', 'dailyUpdate')->name('dailyUpdate');
    Route::get('/permission', 'permission')->name('permission');
    Route::get('/roles', 'role')->name('role');
    Route::get('/reviews', 'review')->name('review');
});
