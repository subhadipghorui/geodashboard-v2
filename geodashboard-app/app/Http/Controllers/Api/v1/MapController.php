<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Layer;
use App\Models\Map;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index(){
        $authUser = auth()->user();
        $data['maps'] = Map::where('status', 1)
        ->where(function($query) use($authUser) {
            foreach ($authUser->g_groups as $value) {
                $query->orWhereJsonContains('g_groups', $value);
            }
        })->get();
        return response()->json([
            "error" => false,
            "message" => "Fetched all maps",
            "errorCode" => null,
            "data" => $data["map"]
        ]);
    }
    public function view($id){
        $authUser = auth()->user();
        $data=[];
        if(!empty($authUser)){
            $data['map'] = Map::where("g_uuid", $id)->where('status', 1)->first();
            if(empty(array_intersect($data['map']->g_groups, $authUser->g_groups))){
                return response()->json([
                    "error" => true,
                    "message" => "Access denide",
                    "errorCode" => 403,
                    "data" => []
                ], 403);
            }
        }
        else{
            $data['map'] = Map::where("g_uuid", $id)->whereJsonContains('g_groups', '1')->first();
        }
        if(empty($data['map'])) return  response()->json([
            "error" => true,
            "message" => "Not found",
            "errorCode" => 404,
            "data" => []
        ], 404);

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
