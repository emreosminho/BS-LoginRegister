<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shelf;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class ShelfController extends Controller
{
    public function index(Request $request)
    {
        $shelf = Shelf::get();
        return response()->json($shelf);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'warehouse_id' => 'required|integer|exists:warehouse,id',
                'block' => 'required|string',
                'shelf_name' => 'required|string',
            ]);

            $shelf = new Shelf($validatedData);
            $shelf -> warehouse_id = $request -> warehouse_id;
            $shelf -> block = $request -> block;
            $shelf -> shelf_name = $request -> shelf_name;
            $shelf->save();

            return response()->json(['message' => 'Raf eklendi...']);
        }catch (ValidationException $e){
            return response()->json(['errors'=>$e->errors()]);
        }catch (\Exception $e){
            return response()->json(['message'=>'Raf eklenemedi...']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'warehouse_id' => 'required|integer|exists:warehouse,id',
                'block' => 'required|string',
                'shelf_name' => 'required|string',
            ]);

            $shelf = Shelf::where('id', $id)->first();

            if ($shelf) {
                $shelf->update([
                    'warehouse_id' => $request->warehouse_id,
                    'block' => $request->block,
                    'shelf_name' => $request->shelf_name,
                ]);
                return response()->json(['message'=>'Raf güncellendi...']);
            } else {
                return response()->json(['message'=>'Raf bulunamadı...']);
            }
        }catch (ValidationException $e){
            return response()->json(['errors'=>$e->errors()]);
        }catch (\Exception $e){
            return response()->json(['message'=>'Raf güncellenemedi...']);
        }
    }

    public function delete(Request $request, $id)
    {
        $shelf = Shelf::find($id);
        if ($shelf){
            $shelf->delete();
            return response()->json(['message'=>'Raf silindi...']);
        }else{
            return response()->json(['message'=>'Raf silinemedi...']);
        }
    }

}
