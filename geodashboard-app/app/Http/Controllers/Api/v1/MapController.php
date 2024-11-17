<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Map;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index(){
        $data["map"] = Map::all();
        return response()->json([
            "error" => false,
            "message" => "Fetched all maps",
            "errorCode" => null,
            "data" => $data["map"]
        ]);
    }
    public function view($id){
        $data["map"] = Map::where('g_uuid', $id)->first();
        return response()->json([
            "error" => false,
            "message" => "Fetched map details.",
            "errorCode" => null,
            "data" => $data["map"]
        ]);
    }
    public function update(Request $request, $id){
        $data["map"] = Map::findOrFail($id);
        $data["map"]->update($request->all());
        return response()->json([
            "error" => false,
            "message" => "Update Successfull",
            "errorCode" => null,
            "data" => $data["map"]
        ]);
    }
}
