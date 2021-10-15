<?php

namespace App\Pages;

use App\Loaders\ContactLoader;
use App\TemplateEngine;

class HomePage
{
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
