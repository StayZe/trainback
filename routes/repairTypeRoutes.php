<?php
require_once 'controllers/RepairTypeController.php';

function handleRepairTypeRoutes($method, $uri)
{
    if ($method === 'GET') {
        RepairTypeController::index();
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
    }
}
