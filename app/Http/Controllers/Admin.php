<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class Admin extends Controller
{
    /**
     * Show admin index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $client = new Client();

        // Get awesome words list
        $words = $client->request('GET', config('app.api_url').'words', [
            'verify' => false
        ]);
        $words = json_decode($words->getBody(), true);
        $words = collect($words);

        return view('admin.welcome',compact('words'));
    }

}
