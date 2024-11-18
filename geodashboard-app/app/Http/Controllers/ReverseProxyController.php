<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ReverseProxyController extends Controller
{
    public function tomcatProxy(Request $request)
    {
        $client = new Client(['base_uri' => env("TOMCAT_APP_URL",'http://localhost:8080')]);
        $url = str_replace("tomcat-proxy/", "", $request->getPathInfo());
        $headers = $request->header();
        $geoserver_auth = env("GEOSERVER_TOKEN", "");
        if(!empty($geoserver_auth)){
            $headers = array_merge($request->header(), [
                'Authorization' => 'Basic ' . $geoserver_auth // Basic Authentication
            ]);
        }
        $response = $client->request($request->method(), $url, [
            'headers' => $headers,
            'query' => $request->query(),
            'json' => $request->json(),
            'body' => $request->getContent(),
        ]);
        return response($response->getBody(), $response->getStatusCode())
            ->withHeaders($response->getHeaders());
    }
}
