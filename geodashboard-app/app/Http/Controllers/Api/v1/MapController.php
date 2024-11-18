<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Layer;
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
        $data["map"]->g_layers = array_map(function($item){
            if(!empty($item['layers'])){
                $item['layers'] = array_map(function($layer){
                    $res = [];
                    $res = Layer::findOrFail($layer["id"])->toArray();
                    $res["checked"] = $layer["checked"];
                    $res["status"] = $layer["status"];
                    return $res;
                }, $item['layers']);
            }
            return $item;
        }, $data["map"]->g_layers);
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
