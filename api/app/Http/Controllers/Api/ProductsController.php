<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Products::get();
        return response()->json([$products],201);
    }

    public function store(Request $request)
    {
        $productBrandName = ProductBrand::find($request->product_brand_id)->name;

        $product = new Products();
        $product-> stock_code = $request->stock_code;
        $product-> product_name = $request->product_name;
        $product-> product_type = $request->product_type;
        $product-> car_type = $request->car_type;
        $product-> product_brand_id = $request->product_brand_id;
        $product-> unit = $request->unit;
        $product-> photo = $request->photo;
        $product->save();
        return response()->json(['message'=>'Ürün Eklendi'],200);

    }

    public function update(Request $request, $stock_code)
    {
        $request->validate([
            'stock_code' => 'required|integer',
            'product_name' => 'required|string|max:255',
            'product_type' => 'required|string|max:255',
            'car_type' => 'required|string|max:255',
            'product_brand_id' => 'required', // Validation for product_brand_id
            'unit' => 'required|string|max:255',
            'photo' => 'nullable|string|max:255',
        ]);

            $product = Products::where('stock_code', $stock_code)->first();

            // Check if the product exists
            if ($product) {
                $product->stock_code = $request->stock_code;
                $product->product_name = $request->product_name;
                $product->product_type = $request->product_type;
                $product->car_type = $request->car_type;
                $product->product_brand_id = $request->product_brand_id;
                $product->unit = $request->unit;
                $product->photo = $request->photo;
                $product->update();

                return response()->json(['message' => 'Ürün güncellendi'], 200);
            }
            else{
                return response()->json(['message' => 'Ürün bulunamadı'], 404);
            }

    }

    public function delete(Request $request, $stock_code)
    {
        $product = Products::where('stock_code', $stock_code)->first();
        if ($product){
            $product->delete();
            return response()->json(['message'=>'Ürün silindi']);
        }
        else{
            return response()->json(['message'=>'Ürün bulunamadı.']);
        }
    }
}
