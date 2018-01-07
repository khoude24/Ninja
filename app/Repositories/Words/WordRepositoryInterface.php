<?php

namespace App\Repositories\Words;

use Illuminate\Http\Request;

interface WordRepositoryInterface
{


    /**
     * Get awesome words list
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();


    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function validWord();


    /**
     * Save new awesome word
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request);


    /**
     * Update awesome word
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id);


    /**
     * Delete an awesome word
     * @param $id
     */
    public function destroy($id);
}
