<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;
use App\Models\Products;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Products::get();
        return response()->json([$products],201);
    }

    public function store(Request $request)
    {


        try {
            // $productBrandName = ProductBrand::find($request->product_brand_id)->name;
            $validateData = $request->validate([
                'stock_code' => 'required|integer',
                'product_name' => 'required|string|max:255',
                'product_type' => 'required|string|max:255',
                'car_type' => 'required|string|max:255',
                'product_brand_id' => 'required|exists:productbrand,id',
                'unit' => 'required|string|max:255',
                'photo' => 'nullable|string|max:255',
            ]);
            $product = new Products($validateData);

            $product-> stock_code = $request->stock_code;
            $product-> product_name = $request->product_name;
            $product-> product_type = $request->product_type;
            $product-> car_type = $request->car_type;
            $product-> product_brand_id = $request->product_brand_id;
            $product-> unit = $request->unit;
            $product-> photo = $request->photo;
            $product->save();

            return response()->json(['message'=>'Ürün Eklendi'],200);
        }catch (ValidationException $e){
            return response()->json(['errors'=>$e->errors()]);
        }catch (\Exception $e){
            return response()->json(['message'=>'Ürün Eklenemedi...']);
        }

    }

    public function update(Request $request, $stock_code)
    {
        try {
            $request->validate([
                'stock_code' => 'required|integer',
                'product_name' => 'required|string|max:255',
                'product_type' => 'required|string|max:255',
                'car_type' => 'required|string|max:255',
                'product_brand_id' => 'required|exists:productbrand,id',
                'unit' => 'required|string|max:255',
                'photo' => 'nullable|string|max:255',
            ]);

            $product = Products::where('stock_code', $stock_code)->first();

            if ($product) {
                $product->update([
                    'stock_code' => $request->stock_code,
                    'product_name' => $request->product_name,
                    'product_type' => $request->product_type,
                    'car_type' => $request->car_type,
                    'product_brand_id' => $request->product_brand_id,
                    'unit' => $request->unit,
                    'photo' => $request->photo,
                ]);
                return response()->json(['message'=>'Ürün güncellendi']);
            } else {
                return response()->json(['message' => 'Ürün bulunamadı']);
            }
        }catch (ValidationException $e){
            return response()->json(['errors'=>$e->errors()]);
        }catch (\Exception $e){
            return response()->json(['message'=>'Ürün güncellenemedi...']);
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
            return response()->json(['message'=>'Ürün silinemedi.']);
        }
    }
}
