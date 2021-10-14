<?php

namespace App\Pages;

use App\Loaders\ContactLoader;
use App\Traits\JsonResponseTrait;

class HomePage
{
    use JsonResponseTrait;

    public function __construct()
    {
        $this->contactLoader = new ContactLoader();
    }

    public function show()
    {
        $contacts = $this->contactLoader->loadAll();

        $this->toJson($contacts);
    }
}
