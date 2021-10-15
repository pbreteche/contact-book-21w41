<?php

namespace App\Pages;

use App\Loaders\ContactLoader;
use App\Traits\JsonResponseTrait;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class HomePage
{
    use JsonResponseTrait;

    public function __construct()
    {
        $this->contactLoader = new ContactLoader();
        $loader = new FilesystemLoader(__DIR__.'/../../templates');
        $this->twig = new Environment($loader, [
            'cache' => __DIR__.'/../../cache',
        ]);
    }

    public function show()
    {
        $contacts = $this->contactLoader->loadAll();

        echo $this->twig->render('homepage.html.twig', [
            'contacts' => $contacts,
        ]);
    }
}
