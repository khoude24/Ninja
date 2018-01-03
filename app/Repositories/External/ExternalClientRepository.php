<?php

namespace App\Repositories\External;

use GuzzleHttp\Client;

class ExternalClientRepository implements ExternalClientRepositoryInterface
{
    public function call($section, $query, $method, $array = true)
    {
        $url = config('app.api_url');

        $client = new Client(); //GuzzleHttp\Client

        $result = $client->request($method, $url.$section, [
            'query' => $query,
            'verify' => false
        ]);

        return $result->getBody();
    }
}
