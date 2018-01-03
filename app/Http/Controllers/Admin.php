<?php

namespace App\Http\Controllers;

use App\Repositories\External\ExternalClientRepositoryInterface;

class Admin extends Controller
{
    private $external;

    public function __construct(ExternalClientRepositoryInterface $external)
    {
        $this->external = $external;
    }

    /**
     * Show admin index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Get awesome words list
        $words = $this->external->call('words',[], 'GET');

        $words = json_decode($words, true);
        $words = collect($words);

        return view('admin.welcome',compact('words'));
    }

}
