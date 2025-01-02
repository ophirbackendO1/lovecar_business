<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function details(Request $request)
    {
        return Inertia::render('Business/Details', [
            'shop_id' => $request->shop_id
        ]);
    }

    public function create()
    {
        return Inertia::render('Business/Create');
    }

    public function edit(){
        return Inertia::render('Business/Edit');
    }

    public function dailyUpdate(Request $request){
        return Inertia::render('Business/DailyUpdate', [
            'shop_id' => $request->shop_id
        ]);
    }

    public function permission(Request $request){
        return Inertia::render('Business/Permission',[
            'shop_id' => $request->shop_id
        ]);
    }

    public function role(Request $request){
        return Inertia::render('Business/Role',[
            'shop_id' => $request->shop_id
        ]);
    }

    public function review(Request $request){
        return Inertia::render('Business/Review', [
            'shop_id' => $request->shop_id
        ]);
    }
}
