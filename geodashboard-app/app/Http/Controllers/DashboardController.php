<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $authUser = auth()->user();
        $data['maps'] = Map::where('status', 1)
        ->where(function($query) use($authUser) {
            foreach ($authUser->g_groups as $value) {
                $query->orWhereJsonContains('g_groups', $value);
            }
        })->get();
        return view('dashboard.index', compact('data'));
    }

    public function view($id){
        $authUser = auth()->user();
        $data=[];
        if(!empty($authUser)){
            $data['map'] = Map::where("g_uuid", $id)->first();
            if(!empty(array_intersect($data['map']->g_groups, $authUser->g_groups))){
                return view('dashboard.'.$data['map']->g_template);
            }
        }
        else{
            $data['map'] = Map::where("g_uuid", $id)->whereJsonContains('g_groups', '1')->first();
        }
        if(empty($data['map'])) abort(404);
        return view('dashboard.'.$data['map']->g_template);
    }
}
