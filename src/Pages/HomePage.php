<?php

namespace App\Pages;

use App\Loaders\ContactLoader;

class HomePage
{
    public function __construct()
    {
        $this->contactLoader = new ContactLoader();
    }

    public function show()
    {
        $contacts = $this->contactLoader->loadAll();

        header('Content-type: application/json');

        echo json_encode($contacts);
    }
}
