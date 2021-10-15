<?php

namespace App\Pages;

use App\Loaders\ContactLoader;
use App\Traits\JsonResponseTrait;
use App\TemplateEngine;

class SearchPage
{
    use JsonResponseTrait;

    public function __construct()
    {
        $this->contactLoader = new ContactLoader();
        $this->twig = TemplateEngine::getEnvironment();
    }

    public function show()
    {
        $searchTerm = $_GET['name'] ?? '';
        $contacts = $this->contactLoader->search($searchTerm);

        echo $this->twig->render('search.html.twig', [
            'contacts' => $contacts,
            'search_term' => $searchTerm
        ]);
    }
}
