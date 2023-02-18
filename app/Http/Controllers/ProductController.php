<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($shop_code)
    {
        $product = DB::table('tblproduct')->where('shop_code', $shop_code)->where('deleted', 0)->get();
        return response()->json([
            "data" => ProductResource::collection($product)
        ]);
        // return response()->json([
        //     "data" =>$product
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validating data
        $validator = Validator::make(
            $request->all(),
            [
                "product_name" => "required",
                "product_weight" => "required|numeric",
                "pack_price" => "required|numeric",
                "unit_price" => "required|numeric"
            ],
            [
                "product_name.required" => "product name is not provided",
                "pack_price.required" => "pack price is not provided",
                "product_weight.required" => "product weight  is not provided",
                "unit_price.required" => "unit price is not provided"

            ]

        );
        if ($validator->fails()) {
            return response()->json([
                "ok" => true,
                "msg" => "Adding product failed" . join(". ", $validator->errors()->all())
            ]);
        }
        try {
            $productnum = DB::table('tblproduct')->where('shop_code', $request->shop_code)->where('deleted', '0')->get();
            $tableCount = $productnum->count();
            $tableCount++;
            $prefix = 'P';
            $product_code = null;

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
            DB::table('tblproduct')->insert([
                "product_code" => $product_code,
                "product_name" => $request->product_name,
                "product_weight" => $request->product_weight,
                "unit_price" => $request->unit_price,
                "pack_price" => $request->pack_price,
                "shop_code" => $request->shop_code,
                "product_quantity" => $request->product_quantity,
                "deleted" => "0",
                "expiry_date" => date('Y-m-d'),
                "recorded_date" => date('Y-m-d'),
                "added_by" => $request->user_id

            ]);
            return response()->json([
                "ok" => true,
            ]);
        } catch (\Throwable $e) {
            Log::error("Failed adding product: " . $e->getMessage());
            return response()->json([
                "ok" => false,
                "msg" => "Adding product failed!",

            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProduct(Request $request)
    {
        //updating products
        $product = DB::table('tblproduct')->where("shop_code", $request->shop_code)->where("product_code", $request->product_code);
        if ($product->count() == 0) {
            return response()->json([
                "ok" => false,
                "msg" => "Inalid product code provided"
            ]);
        }
        $updateProduct = $product->update([
            "product_name" => $request->product_name,
            "product_quantity" => $request->product_quantity,
            "unit_price" => $request->unit_price,
            "pack_price" => $request->pack_price
        ]);
        if (!$updateProduct) {
            return response()->json([
                "ok" => false,
                "data" => $product->get(),
                "msg" => "an external error occured"
            ]);
        }
        return response()->json([
            "ok" => true,
            "data" => $product->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
