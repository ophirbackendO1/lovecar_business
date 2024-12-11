<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SettingController;

Route::get('/settings',[SettingController::class,'index']);
Route::post('/setToken',function(Request $request){
    session(['token',$request->token]);
    return sendResponse(null,200,'success');
});
