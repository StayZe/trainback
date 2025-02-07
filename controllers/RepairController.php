<?php
require_once 'models/Repair.php';

class RepairController
{
    public static function index()
    {
        echo json_encode(Repair::getAll());
    }

    public static function store()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        // Ajoute un log pour voir les données reçues
        error_log("Données reçues : " . json_encode($data));

        if (!isset($data['train_id']) || !isset($data['repair_type_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid data', 'received' => $data]);
            return;
        }

        echo json_encode(Repair::create($data['train_id'], $data['repair_type_id']));
    }


    public static function destroy($id)
    {
        if (Repair::delete($id)) {
            echo json_encode(['success' => 'Repair deleted']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Delete failed']);
        }
    }

    public static function getRepairTypes()
    {
        echo json_encode(Repair::getAllRepairTypes());
    }
}
