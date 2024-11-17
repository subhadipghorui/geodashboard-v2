<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view($id){
        $data['map'] = Map::where("g_uuid", $id)->first();
        return view('dashboard.'.$data['map']->g_template);
    }
}
