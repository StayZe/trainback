<?php
require_once 'controllers/TrainController.php';

function handleTrainRoutes($method, $uri)
{
    $parts = explode('/', trim($uri, '/'));

    if ($method === 'GET' && count($parts) === 1) {
        TrainController::index();
    } elseif ($method === 'GET' && count($parts) === 2) {
        TrainController::show($parts[1]);
    } elseif ($method === 'POST') {
        TrainController::store();
    } elseif ($method === 'DELETE' && count($parts) === 2) {
        TrainController::destroy($parts[1]);
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
    }
}
