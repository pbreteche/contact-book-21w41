<?php

namespace App\Pages;

use App\Loaders\ContactLoader;
use App\TemplateEngine;

class DetailPage
{
    public function __construct()
    {
        $this->contactLoader = new ContactLoader();
        $this->twig = TemplateEngine::getEnvironment();
    }

    public function show()
    {
        $id = $_GET['id'] ?? 1;

        $contact = $this->contactLoader->loadById($id);

        echo $this->twig->render('detail.html.twig', [
            'contact' => $contact,
        ]);
    }
}
