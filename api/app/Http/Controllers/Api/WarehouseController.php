<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
   public function index()
   {
       $warehouses = Warehouse::get();
       return response()->json([$warehouses]);
   }

   public function store(Request $request)
   {
       $warehouse = new Warehouse();
       $warehouse -> name = $request -> name;
       $warehouse -> province = $request -> province;
       $warehouse -> district = $request -> district;
       $warehouse -> m2 = $request -> m2;
       $warehouse -> save();

       return response()->json(['message' => 'Ambar eklendi.']);
   }

   public function update(Request $request, $id)
   {
       $request->validate([
           'name'=>'required|string',
           'province'=>'required|string',
           'district'=>'required|string',
           'm2'=>'required|integer',
       ]);

       $warehouse = Warehouse::findOrFail($id);

       if ($warehouse){
           $warehouse -> name = $request -> name;
           $warehouse -> province = $request -> province;
           $warehouse -> district = $request -> district;
           $warehouse -> m2 = $request -> m2;
           $warehouse -> update();

           return response()->json(['message'=>'Ambar güncellendi']);
       }
       else{
           return response()->json(['message' => 'Ambar bulunamadı.']);
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
