<?php

use App\Exception\DataNotFoundException;

require __DIR__.'/../vendor/autoload.php';

$detailPage = new App\Pages\DetailPage();
try {
    $detailPage->show();
} catch (DataNotFoundException $exception) {
    http_response_code(404);
    header('Content-type: application/json');
    echo json_encode([
        'status' => 404,
        'message' => 'contact not found',
    ]);
}
