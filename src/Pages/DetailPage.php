<?php

namespace App\Pages;

use App\Loaders\ContactLoader;
use App\Traits\JsonResponseTrait;

class DetailPage
{
    use JsonResponseTrait;

    public function __construct()
    {
        $this->contactLoader = new ContactLoader();
    }

    public function show()
    {
        $id = $_GET['id'] ?? 1;

        $contact = $this->contactLoader->loadById($id);

        $this->toJson($contact);
    }
}
