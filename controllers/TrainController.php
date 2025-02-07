<?php
require_once 'models/Train.php';

class TrainController
{
    public static function index()
    {
        echo json_encode(Train::getAllWithRepairs());
    }

    public static function show($id)
    {
        echo json_encode(Train::getById($id));
    }

    public static function store()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['name'])) {
            echo json_encode(Train::create($data['name']));
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid data']);
        }
    }

    public static function destroy($id)
    {
        if (Train::delete($id)) {
            echo json_encode(['success' => 'Train deleted']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Delete failed']);
        }
    }
}
