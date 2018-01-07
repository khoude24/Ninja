<?php

namespace App\Http\Controllers;

use App\Repositories\Auth\AuthRepository;
use App\Repositories\External\ExternalClientRepositoryInterface;
use App\Repositories\Words\WordRepositoryInterface;
use Illuminate\Http\Request;

class Words extends Controller
{
    /**
     * @var AuthRepository
     */
    private $authRepository;
    private $external;
    /**
     * @var WordRepositoryInterface
     */
    private $wordRepository;


    public function __construct(AuthRepository $authRepository, ExternalClientRepositoryInterface $external, WordRepositoryInterface $wordRepository)
    {
        $this->authRepository = $authRepository;
        $this->external = $external;
        $this->wordRepository = $wordRepository;
    }

    /**
     * Get awesome words list
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->wordRepository->index();
    }

    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function validWord()
    {
        return $this->wordRepository->validWord();
    }

    /**
     * Save new awesome word
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Add validation
        $this->validate($request, [
            'word'        => 'required|max:100',
            'name' => 'required|max:15',
            'pirate_name' => 'required|max:15'
        ]);

        return $this->wordRepository->store($request);
    }

    /**
     * Update awesome word
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $this->wordRepository->update($request, $id);
    }


    /**
     * Delete an awesome word
     * @param $id
     */
    public function destroy($id)
    {
        $this->wordRepository->destroy($id);
    }
}
