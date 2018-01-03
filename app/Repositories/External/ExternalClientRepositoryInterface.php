<?php

namespace App\Repositories\External;

interface ExternalClientRepositoryInterface
{
    public function call($section, $query, $method, $array = true);

}
