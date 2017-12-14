<?php

namespace App\Http\Controllers;

use App\Repositories\Auth\AuthRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class Words extends Controller
{
    /**
     * @var AuthRepository
     */
    private $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    /**
     * Get awesome words list
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $client = new Client(); //GuzzleHttp\Client
        $stat = $client->get('ninja-backend.test/api/words', ['verify' => false]);

        return response()->json([
            'words'    => json_decode($stat->getBody()),
        ], 200);

    }

    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function validWord()
    {
        $client = new Client(); //GuzzleHttp\Client
        $stat = $client->get(config('app.api_url').'wordsList', ['verify' => false]);
        return strtolower($stat->getBody());
    }

    /**
     * Save new awesome word
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $client = new Client();


        // Add validation
        $this->validate($request, [
            'word'        => 'required|max:100',
            'name' => 'required|max:15',
            'pirate_name' => 'required|max:15'
        ]);

        $response = $client->request('put', config('app.api_url').'words/'.$request->word.'/'.$request->name.'/'.$request->pirate_name, ['verify' => false, 'query' => ['token' => $this->authRepository->login()]]
        );

        return response()->json([
            'word'    => json_decode($response->getBody()),
            'message' => 'Success'
        ], 200);
    }

    /**
     * Update awesome word
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $client = new Client();
        $client->request('patch', config('app.api_url').'words/'.$id.'/'.$request->word.'/'.$request->name.'/'.$request->pirate_name, ['verify' => false, 'query' => ['token' => $this->authRepository->login()]]);
    }


    /**
     * Delete an awesome word
     * @param $id
     */
    public function destroy($id)
    {
        $client = new Client();

        $query = [
            'id' => $id,
            'token' => $this->authRepository->login()
        ];

        $client->request('delete', config('app.api_url').'words/'.$id, [
            'query' => $query,
            'verify' => false
        ]);
    }
}
