<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['maps'] = Map::where('status', 1)->get();
        return view('dashboard.index', compact('data'));
    }

    public function view($id){
        $data['map'] = Map::where("g_uuid", $id)->first();
        return view('dashboard.'.$data['map']->g_template);
    }
}
