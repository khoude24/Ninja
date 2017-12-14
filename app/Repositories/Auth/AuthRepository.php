<?php

namespace App\Repositories\Auth;

use App\Words;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AuthRepository extends Model
{

    public function __construct()
    {
    }

    /**
     * @return JsonResponse
     */
    public function login()
    {
        $client = new Client();

         $query = [
            'email' => 'johndoe@example.com',
            'password' => 'johndoe'
         ];

         $auth = $client->request('post', config('app.api_url').'auth/login', [
            'query' => $query
         ]);


        $token = json_decode($auth->getBody(), true);

        return $token['data']['token'];
    }

}