<?php

namespace App\Repositories\Words;

use Illuminate\Cache\Repository as Cache;
use Illuminate\Http\Request;


class CachingWordRepository implements WordRepositoryInterface
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
    /**
     * @var Cache
     */
    private $cache;


    public function __construct(WordRepositoryInterface $wordRepository, Cache $cache)
    {
        $this->wordRepository = $wordRepository;
        $this->cache = $cache;
    }

    /**
     * Get awesome words list
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->cache->remember(
            'words',
            30,
            function () {
                return $this->wordRepository->index();
            }
        );
    }

    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function validWord()
    {
        return $this->cache->remember(
            'ValidWords',
            30,
            function () {
                return $this->wordRepository->validWord();
            }
        );
    }

    /**
     * Save new awesome word
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->cache->forget('words');
        $this->cache->forget('validWords');
        return $this->wordRepository->store($request);
    }

    /**
     * Update awesome word
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $this->cache->forget('words');
        $this->cache->forget('validWords');
        return $this->wordRepository->update($request, $id);
    }


    /**
     * Delete an awesome word
     * @param $id
     */
    public function destroy($id)
    {
        $this->cache->forget('words');
        $this->cache->forget('validWords');
        return $this->wordRepository->destroy($id);
    }
}
