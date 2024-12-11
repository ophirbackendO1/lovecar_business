<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function details(Request $request){
        return Inertia::render('Business/Details',[
            'shop_id' => $request->shop_id
        ]);
    }
}
