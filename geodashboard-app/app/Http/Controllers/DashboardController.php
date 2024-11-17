<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view($id){

        return view('dashboard.template_mapbox01');
    }
}
