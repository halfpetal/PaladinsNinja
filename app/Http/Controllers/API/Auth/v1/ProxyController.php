<?php

namespace PaladinsNinja\Http\Controllers\API\Auth\v1;

use Illuminate\Http\Request;
use PaladinsNinja\Http\Controllers\Controller;
use PaladinsNinja\Http\Requests\API\Auth\v1\ProxyLoginRequest;
use PaladinsNinja\Http\Requests\API\Auth\v1\ProxyRefreshRequest;

use GuzzleHttp;

class ProxyController extends Controller
{
    public function login(ProxyLoginRequest $request)
    {
        $http = new GuzzleHttp\Client([
            'verify' => false,
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);

        try {
            $response = $http->post(url('oauth/token'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => env('API_AUTH_PROXY_CLIENT_ID'),
                    'client_secret' => env('API_AUTH_PROXY_CLIENT_SECRET'),
                    'username' => $request->get('email'),
                    'password' => $request->get('password'),
                    'scope' => '*'
                ]
            ]);
  
            return response()->json(json_decode($response->getBody(true), true));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            return response()->json(json_decode($e->getResponse()->getBody(true), true));
        }
    }

    public function refresh(ProxyRefreshRequest $request)
    {
        $http = new GuzzleHttp\Client([
            'verify' => false,
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);

        try {
            $response = $http->post(url('oauth/token'), [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $request->get('refresh_token'),
                    'client_id' => env('API_AUTH_PROXY_CLIENT_ID'),
                    'client_secret' => env('API_AUTH_PROXY_CLIENT_SECRET'),
                    'scope' => '*',
                ],
            ]);
  
            return response()->json(json_decode($response->getBody(true), true));
        } catch (GuzzleHttp\Exception\ClientException $e) {
            return response()->json(json_decode($e->getResponse()->getBody(true), true));
        }
    }

}
