<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalesResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    public function index($shop_code)
    {
        $sales = DB::table('tblsales')->where('shop_code', $shop_code)->where('deleted', 0)->get();
        return response()->json([
            "data" => SalesResource::collection($sales)
        ]);
    }
    public function searchItem($data)
    {

        $data = json_decode(html_entity_decode(stripslashes($data)));
        $response = DB::table('tblproduct')->where('shop_code', $data->shop_code)->where('product_name', 'LIKE', '%' . $data->item . '%')->get();
        return response()->json([
            "ok" => true,
            "data" => $response
        ]);
    }
    public function addProduct(Request $request)
    {
        $product_count = $request->product_counter;
        $products = $request->all();

        for ($i = 1; $i <= $product_count; $i++) {
            $tableCount = DB::table('tblsales')->where("shop_code", $request->shop_code)->get()->count();
            $tableCount++;
            $prefix = "S";
            $productCode = null;

            switch (strlen($tableCount)) {
                case 1:
                    $product_code = $prefix . '000' . $tableCount;
                    break;
                case 2:
                    $product_code = $prefix . '00' . $tableCount;
                    break;
                case 3:
                    $product_code = $prefix . '0' . $tableCount;
                    break;
                case 4:
                default:
                    $product_code = $prefix . '' . $tableCount;
                    break;
            }
            $product_name='sold_product_price'.$i;
            $product_quantity='product'.$i;
            $product_price='price'.$i;
            DB::table('tblsales')->insert([
                "product_code" => $product_code,
                "product_name" =>$request-> $product_name,
                "product_quantity" =>$request->$product_quantity,
                "shop_code" => $request->shop_code,
                "added_by" => $request->user,
                "time_added" => date('y-m-d'),
                "unit_price" => $request->$product_price,
                "deleted" => 0
            ]);
        }
        return response()->json([
            "ok" => true,
            "data" => $request->all()
        ]);
    }
}
