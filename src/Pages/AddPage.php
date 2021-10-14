<?php

namespace App\Pages;

use App\Loaders\ContactLoader;
use App\Model\Contact;
use App\Traits\JsonResponseTrait;

class AddPage
{
    use JsonResponseTrait;

    public function __construct()
    {
        $this->contactLoader = new ContactLoader();
    }

    public function show()
    {
        $contact = new Contact();
        $contact->setName($_GET['name']);
        $contact->setEmail($_GET['email']);

        $contactId = $this->contactLoader->save($contact);

        $this->toJson([
            'status' => 'success',
            'insert_id' => $contactId,
        ]);
    }
}
