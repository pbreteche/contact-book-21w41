<?php

namespace App\Pages;

use App\Loaders\ContactLoader;

class DetailPage
{
    public function __construct()
    {
        $this->contactLoader = new ContactLoader();
    }

    public function show()
    {
        $id = $_GET['id'] ?? 1;

        $contact = $this->contactLoader->loadById($id);

        header('Content-type: application/json');

        echo json_encode($contact);
    }
}
