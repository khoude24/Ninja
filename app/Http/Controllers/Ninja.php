<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class Ninja extends Controller
{

    /**
     * Get Ninja/pirate name
     *
     * @param Request $request
     * @return \Psr\Http\Message\StreamInterface
     */
    public function get(Request $request)
    {
        //Get users awesome words
        $x = $request->input('x');

        //If konami code activated, get secret code
        $secret = $request->input('secret');


        $client = new Client(); //GuzzleHttp\Client
        $stat = $client->request('GET', config('app.api_url').'ninjify', [
            'query' => ['x' => $x, 'secret' => $secret],
            'verify' => false
        ]);

        return $stat->getBody();
    }

}
