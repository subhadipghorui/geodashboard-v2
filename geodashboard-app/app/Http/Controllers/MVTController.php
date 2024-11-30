<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class MVTController extends Controller
{
    public function mvt(Request $request)
    {
        $params = $request->all();
        $ds['x'] = $params['x'] ?? 0;
        $ds['y'] = $params['y'] ?? 0;
        $ds['z'] = $params['z'] ?? 0;
        $ds['table_slug'] = $params['table_slug'] ?? "demo";
        $ds['schema'] = $params['schema'] ?? 'public';
        $ds['projection'] = $params['projection'] ?? '3857';
        $ds['geom_column'] = $params['geom_column'] ?? "geom";
        $ds['pixel_size'] = $params['pixel_size'] ?? 4096;
        $ds['source_layer'] = $params['source_layer'] ?? 'default';
        $ds['max_feature_count'] = $params['max_feature_count'] ?? 100000;
        $ds['columns'] = $params['columns'] ?? "";

        if (!empty($ds['columns'])) {
            $pattern = '/^[a-zA-Z0-9_]+(?:,[a-zA-Z0-9_]+)*$/';
            if (!preg_match($pattern, $ds['columns'])) {
                return response()->json(["message" => "Invalid columns"], 400);
            }
            $ds['columns'] .= ',';
        }

        // Execute SQL query to retrieve MVT data
        $mvtResult = DB::connection('sg_geoserver')->select("SELECT ST_AsMVT(mvtgeom.*, '" . $ds['source_layer'] . "', " . $ds['pixel_size'] . ", 'geom1', 'id') AS mvt from (
            SELECT 
                foo.id as id,
                " . $ds['columns'] . "
                ST_AsMVTGeom(
                        ST_TRANSFORM( 
                        foo." . $ds['geom_column'] . "::geometry,
                            " . $ds['projection'] . "
                        ), 
                        ST_TileEnvelope( 
                        " . $ds['z'] . ", 
                        " . $ds['x'] . ", 
                        " . $ds['y'] . "
                        )
                    ) AS geom1

            FROM 
            " . $ds['schema'] . ".\"" . $ds['table_slug'] . "\" AS foo
            group by foo.id LIMIT " . $ds['max_feature_count'] . "
            )AS mvtgeom");

        $mvtData = $mvtResult[0]->mvt;

        if (is_resource($mvtData)) {
            // Return the stream as a response, streaming it directly to the client
            return Response::stream(function () use ($mvtData) {
                while (!feof($mvtData)) {
                    echo fread($mvtData, 8192);  // Read and send the data in chunks (8192 bytes)
                }
                fclose($mvtData);
            }, 200, [
                'Content-Type' => 'application/x-protobuf',  // MVT uses protobuf format
                'Content-Disposition' => 'inline; filename="tile.mvt"',  // Suggest a filename for download
                'Cache-Control' => 'public, max-age=3600',  // Caching settings (adjust as needed)
            ]);
        } else {
            // Handle the error if the data isn't a valid stream
            return response("Error: The MVT data is not a valid stream.", 500);
        }
        // while (!feof($mvtData[0]->mvt)) {
        //     echo fread($mvtData[0]->mvt, 8192);
        // }

        // // Close the stream
        // fclose($mvtData[0]->mvt);

        // return  response("", 200, [
        //     'Content-Type' => 'application/x-protobuf',
        //     'Content-Disposition' => 'inline; filename="tile.mvt"',
        // ]);
    }




    // public function mvt(Request $request)
    // {
    //     $params = $request->all();
    //     $ds['x'] = $params['x'] ?? 0;
    //     $ds['y'] = $params['y'] ?? 0;
    //     $ds['z'] = $params['z'] ?? 0;
    //     $ds['table_slug'] = $params['table_slug'] ?? "demo";
    //     $ds['schema'] = $params['schema'] ?? 'public';
    //     $ds['projection'] = $params['projection'] ?? '3857';
    //     $ds['geom_column'] = $params['geom_column'] ?? "geom";
    //     $ds['pixel_size'] = $params['pixel_size'] ?? 4096;
    //     $ds['source_layer'] = $params['source_layer'] ?? 'default';
    //     $ds['max_feature_count'] = $params['max_feature_count'] ?? 100000;
    //     $ds['columns'] = $params['columns'] ?? "";
    //     $ds['cache'] = $params['cache'] ?? true;
    //     $ds['cache_time'] = $params['cache_time'] ?? 300;

    //     if (!empty($ds['columns'])) {
    //         $pattern = '/^[a-zA-Z0-9_]+(?:,[a-zA-Z0-9_]+)*$/';
    //         if (!preg_match($pattern, $ds['columns'])) {
    //             return response()->json(["message" => "Invalid columns"], 400);
    //         }
    //         $ds['columns'] .= ',';
    //     }


    //     // Fetching the MVT data from the database
    //     $mvtDataResult = DB::connection('sg_geoserver')->select("SELECT ST_AsMVT(mvtgeom.*, '" . $ds['source_layer'] . "', " . $ds['pixel_size'] . ", 'geom1', 'id') AS mvt from (
    //     SELECT 
    //         foo.id as id,
    //         " . $ds['columns'] . "
    //         ST_AsMVTGeom(
    //             ST_TRANSFORM( 
    //                 foo." . $ds['geom_column'] . "::geometry,
    //                 " . $ds['projection'] . "
    //             ), 
    //             ST_TileEnvelope( 
    //                 " . $ds['z'] . ", 
    //                 " . $ds['x'] . ", 
    //                 " . $ds['y'] . "
    //             )
    //         ) AS geom1
    //     FROM 
    //         " . $ds['schema'] . ".\"" . $ds['table_slug'] . "\" AS foo
    //     GROUP BY foo.id LIMIT " . $ds['max_feature_count'] . "
    // ) AS mvtgeom");



    //     $mvtData = $mvtDataResult[0]->mvt;
    //     $mvtDataString = stream_get_contents($mvtData);
    //     \Log::debug($mvtDataString);
    //     Cache::put('mvt_cache_' . md5($ds['table_slug'] . $ds['z'] . $ds['x'] . $ds['y']), $mvtDataString, now()->addSeconds(3600)); // Cache for 1 hour

    //     $aa = Cache::get('mvt_cache_' . $ds['table_slug'] . $ds['z'] . $ds['x'] . $ds['y']);
    //     \Log::debug($aa);


    //     if ($aa !== null) {
    //         // Recreate the stream resource from the string
    //         $mvtDataResource = fopen('php://memory', 'r+b');
    //         fwrite($mvtDataResource, $aa);
    //         rewind($mvtDataResource); // Move the pointer back to the beginning of the stream

    //         // Now you can use $mvtDataResource like the original stream
    //         // For example, to stream it to a client:
    //         return Response::stream(function () use ($mvtDataResource) {
    //             while (!feof($mvtDataResource)) {
    //                 echo fread($mvtDataResource, 8192);  // Read and send data in chunks
    //             }
    //         }, 200, [
    //             'Content-Type' => 'application/x-protobuf',
    //             'Content-Disposition' => 'inline; filename="tile.mvt"',
    //         ]);
    //     }

    //     // // Ensure it's a valid stream resource before starting the response
    //     // if (is_resource($mvtData)) {
    //     //     // Return the stream as a response, streaming it directly to the client
    //     //     return Response::stream(function () use ($mvtData) {
    //     //         while (!feof($mvtData)) {
    //     //             echo fread($mvtData, 8192);  // Read and send the data in chunks (8192 bytes)
    //     //         }
    //     //         fclose($mvtData);
    //     //     }, 200, [
    //     //         'Content-Type' => 'application/x-protobuf',  // MVT uses protobuf format
    //     //         'Content-Disposition' => 'inline; filename="tile.mvt"',  // Suggest a filename for download
    //     //     ]);
    //     // } else {
    //     //     dd($mvtData);
    //     //     // Handle the error if the data isn't a valid stream
    //     //     return response("Error: The MVT data is not a valid stream.", 500);
    //     // }
    // }
}
