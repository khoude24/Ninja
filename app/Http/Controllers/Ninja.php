<?php

namespace App\Http\Controllers;

use App\Repositories\External\ExternalClientRepositoryInterface;
use Illuminate\Http\Request;

class Ninja extends Controller
{
    private $external;

    public function __construct(ExternalClientRepositoryInterface $external)
    {
        $this->external = $external;
    }

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

        $test =  $this->external->call('ninjify', ['x' => $x, 'secret' => $secret], 'GET', false);

        return $test;
    }

}
