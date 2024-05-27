<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Nette\Schema\ValidationException;

class WarehouseController extends Controller
{
   public function index()
   {
       $warehouses = Warehouse::get();
       return response()->json([$warehouses]);
   }

   public function store(Request $request)
   {
       try {

           $validateData = $request->validate([
               'name'=>'required|string',
               'province'=>'required|string',
               'district'=>'required|string',
               'm2'=>'required|integer',
           ]);

           $warehouse = new Warehouse();
           $warehouse -> name = $request -> name;
           $warehouse -> province = $request -> province;
           $warehouse -> district = $request -> district;
           $warehouse -> m2 = $request -> m2;
           $warehouse -> save();

           return response()->json(['message' => 'Ambar eklendi.']);
       }catch (ValidationException $e){
           return response()->json(['errors' => $e->errors()]);
       }catch (\Exception $e){
           return response()->json(['message' => 'Ambar eklenemedi...']);
       }

   }

   public function update(Request $request, $id)
   {
       try {
           $request->validate([
               'name'=>'required|string',
               'province'=>'required|string',
               'district'=>'required|string',
               'm2'=>'required|integer',
           ]);

           $warehouse = Warehouse::where('id', $id)->first();
           if ($warehouse){
               $warehouse->update([
                   'name' => $request -> name,
                   'province' => $request -> province,
                   'district' => $request -> district,
                   'm2' => $request -> m2,
               ]);
               return response()->json(['message'=>'Ambar güncellendi...']);
           }else{
               return response()->json(['message'=>'Ambar güncellenemedi...']);
           }
           return response()->json(['message'=>'Ambar güncellendi']);
       }catch (ValidationException $e){
           return response()->json(['errors'=>$e->errors()]);
       }catch (\Exception $e){
           return response()->json(['message'=>'Ambar güncellenemedi...']);
       }

   }

   public function delete(Request $request, $id)
   {
       $warehouse = Warehouse::findOrFail($id);
       if ($warehouse){
           $warehouse->delete();
           return response()->json(['message'=>'Ambar silindi']);
       }
       else{
           return response()->json(['message'=>'Ambar bulunamadı.']);
       }
   }
}
