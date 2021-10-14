<?php

namespace App\Pages;

use App\Loaders\ContactLoader;
use App\Traits\JsonResponseTrait;

class SearchPage
{
    use JsonResponseTrait;

    public function __construct()
    {
        $this->contactLoader = new ContactLoader();
    }

    public function show()
    {
        $contacts = $this->contactLoader->search($_GET['name']);

        $this->toJson($contacts);
    }
}
