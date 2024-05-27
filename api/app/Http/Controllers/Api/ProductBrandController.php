<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class ProductBrandController extends Controller
{
    public function index()
    {
        $productBrands = ProductBrand::get();
        return response()->json([$productBrands], 201);
    }

    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required|string',
            ]);

            $productBrand = new ProductBrand();
            $productBrand->name = $request->name;
            $productBrand->save();
            return response()->json(['message'=>'Marka eklendi'], 201);
        }catch (ValidationException $e){
            return response()->json(['errors'=>$e->errors()]);
        }catch (\Exception $e){
            return response()->json(['message'=>'Marka eklenemedi...']);
        }

    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $productBrand = ProductBrand::findOrFail($id);
            $productBrand->name = $request->name;
            $productBrand->update();

            return response()->json(['message' => 'Ürün markası güncellendi'], 200);
        }catch (ValidationException $e){
            return response()->json(['errors'=>$e->errors()]);
        }catch (\Exception $e){
            return response()->json(['message'=>'Marka güncellenemedi']);
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
