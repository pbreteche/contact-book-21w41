<?php

namespace App\Pages;

use App\Loaders\ContactLoader;
use App\Traits\JsonResponseTrait;
use App\TemplateEngine;

class HomePage
{
    use JsonResponseTrait;

    public function __construct()
    {
        $this->contactLoader = new ContactLoader();
        $this->twig = TemplateEngine::getEnvironment();
    }

    public function show()
    {
        $contacts = $this->contactLoader->loadAll();

        echo $this->twig->render('homepage.html.twig', [
            'contacts' => $contacts,
        ]);
    }
}
