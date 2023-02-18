<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{

    public function dashboard()
    {
        $productNum = DB::table('tblproduct')->where('shop_code', Auth::user()->shop_code)->where('deleted', 0)->get()->count();
        return view('dashboard', [
            "productNum" => $productNum
        ]);
    }
    //Products controller
    public function product()
    {
        return view('modules.products.index');
    }
    //sales controller
    public function sale(){
        return view('modules.sales.index');
    }
}
