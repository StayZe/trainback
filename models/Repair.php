<?php
require_once 'Database.php';

class Repair
{
    public static function getAll()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM repairs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($trainId, $repairTypeId)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO repairs (train_id, repair_type_id) VALUES (?, ?) RETURNING id");
        $stmt->execute([$trainId, $repairTypeId]);

        return ['id' => $stmt->fetchColumn(), 'train_id' => $trainId, 'repair_type_id' => $repairTypeId];
    }


    public static function delete($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM repairs WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function getAllRepairTypes()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT id, name FROM repair_types ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
