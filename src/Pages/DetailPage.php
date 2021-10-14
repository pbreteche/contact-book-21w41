<?php

namespace App\Pages;

use App\Loaders\ContactLoader;
use App\Traits\JsonResponseTrait;
use App\Exception\DataNotFoundException;

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

        try {
            $contact = $this->contactLoader->loadById($id);
        } catch (DataNotFoundException $exception) {
            http_response_code(404);
            $this->toJson([
                'status' => 404,
                'message' => 'contact not found',
            ]);
            die;
        } catch (\Exception $exception) {
            http_response_code(500);
            $this->toJson([
                'status' => 500,
                'message' => 'application crashed, try later',
            ]);
            die;
        }

        $this->toJson($contact);
    }
}
