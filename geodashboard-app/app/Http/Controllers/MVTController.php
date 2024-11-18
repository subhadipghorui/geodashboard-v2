<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MVTController extends Controller
{
    public function mvt(Request $request){
        $params = $request->all();
        $ds['x'] = $params['x'] ?? 0;
        $ds['y'] = $params['y'] ?? 0;
        $ds['z'] = $params['z'] ?? 0;
        $ds['table_slug'] = $params['table_slug'] ?? "demo";
        $ds['schema'] = $params['schema'] ?? 'public';
        $ds['projection'] = $params['projection'] ?? '3857';
        $ds['pixel_size'] = $params['pixel_size'] ?? 4096;
        $ds['source_layer'] = $params['source_layer'] ?? 'default';
        $ds['max_feature_count'] = $params['max_feature_count'] ?? 100000;
        $ds['columns'] = $params['columns'] ?? "";

        if(!empty($ds['columns'])){
            $pattern = '/^[a-zA-Z0-9_]+(?:,[a-zA-Z0-9_]+)*$/';
            if (!preg_match($pattern, $ds['columns'])) {
                return response()->json(["message" => "Invalid columns"], 400);
            }
            $ds['columns'] .= ',';
        }


        // \Log::debug("message");
        // \Log::debug($ds);
         // Execute SQL query to retrieve MVT data
         $mvtData = DB::connection('sg_geoserver')->select("SELECT ST_AsMVT(mvtgeom.*, '".$ds['source_layer']."', ".$ds['pixel_size'].", 'geom1', 'id') AS mvt from (
            SELECT 
                foo.id as id,
                ".$ds['columns']."
                ST_AsMVTGeom(
                        ST_TRANSFORM( 
                        foo.geom::geometry,
                            ".$ds['projection']."
                        ), 
                        ST_TileEnvelope( 
                        ".$ds['z'].", 
                        ".$ds['x'].", 
                        ".$ds['y']."
                        )
                    ) AS geom1
                    
            FROM 
            ".$ds['schema'].".\"".$ds['table_slug']."\" AS foo
            group by foo.id LIMIT ".$ds['max_feature_count']."
            )AS mvtgeom");


            while (!feof($mvtData[0]->mvt)) {
                echo fread($mvtData[0]->mvt, 8192);
              }
              
              // Close the stream
              fclose($mvtData[0]->mvt);
              exit;
    }
}
