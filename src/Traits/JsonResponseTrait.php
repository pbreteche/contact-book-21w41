<?php

namespace App\Traits;

trait JsonResponseTrait
{
    public function toJson($data)
    {
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
