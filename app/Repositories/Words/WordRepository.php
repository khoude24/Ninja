<?php

namespace App\Repositories\Words;

use App\Repositories\Auth\AuthRepository;
use App\Repositories\External\ExternalClientRepositoryInterface;
use Illuminate\Http\Request;

class WordRepository implements WordRepositoryInterface
{
    /**
     * @var AuthRepository
     */
    private $authRepository;
    private $external;


    public function __construct(ExternalClientRepositoryInterface $external, AuthRepository $authRepository)
    {
        $this->external = $external;
        $this->authRepository = $authRepository;
    }

    /**
     * Get awesome words list
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'words'    => json_decode($this->external->call('words', [], 'GET')),
        ], 200);
    }

    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function validWord()
    {
        return strtolower($this->external->call('wordsList', [], 'GET'));
    }

    /**
     * Save new awesome word
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $response = $this->external->call('words/'.$request->word.'/'.$request->name.'/'.$request->pirate_name, ['token' => $this->authRepository->login()], 'put');

        return response()->json([
            'word'    => json_decode($response),
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
        $this->external->call('words/'.$id.'/'.$request->word.'/'.$request->name.'/'.$request->pirate_name, ['token' => $this->authRepository->login()], 'patch');
    }


    /**
     * Delete an awesome word
     * @param $id
     */
    public function destroy($id)
    {
        $this->external->call('words/'.$id, ['token' => $this->authRepository->login()], 'delete');
    }
}
