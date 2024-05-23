<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    public function index()
    {
        $productBrands = ProductBrand::get();
        return response()->json([$productBrands], 201);
    }

    public function store(Request $request)
    {
        $productBrand = new ProductBrand();
        $productBrand->name = $request->name;
        $productBrand->save();
        return response()->json(['message'=>'Eklendi'], 201);
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $productBrand = ProductBrand::findOrFail($id);

        if ($productBrand){
            $productBrand->name = $request->name;
            $productBrand->update();

            return response()->json(['message' => 'Ürün markası güncellendi'], 200);
        }
        else
        {
            return response()->json(['message' => 'Ürün Bulunamadı'], 404);
        }

    }

    public function delete(Request $request, $id)
    {
        $productBrand = ProductBrand::find($id);
        if ($productBrand){
            $productBrand->delete();
            return response()->json(['message'=>'Ürün başarıyla silindi'],200);
        }
        else
        {
            return response()->json(['message'=>'Ürün bulunamadı'],404);
        }
    }
}
