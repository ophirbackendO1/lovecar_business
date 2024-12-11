<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    public function __construct(protected Setting $model)
    {

    }

    public function index(Request $request){
        $data = $this->model->when($request->key,function($query) use ($request){
            $query->where('key',$request->key);
        })->get();

        return sendResponse($data,200);

    }
}
