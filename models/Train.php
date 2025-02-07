<?php
require_once 'Database.php';

class Train
{
    public static function getAll()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM trains");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM trains WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($name)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO trains (name) VALUES (?) RETURNING id");
        $stmt->execute([$name]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function delete($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM trains WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function getAllWithRepairs()
    {
        $db = Database::connect();
        $stmt = $db->query("
            SELECT t.id AS train_id, t.name AS train_name, 
                   r.id AS repair_id, rt.name AS repair_type, r.repair_date
            FROM trains t
            LEFT JOIN repairs r ON t.id = r.train_id
            LEFT JOIN repair_types rt ON r.repair_type_id = rt.id
            ORDER BY t.id, r.repair_date
        ");

        $trains = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $trainId = $row['train_id'];

            if (!isset($trains[$trainId])) {
                $trains[$trainId] = [
                    'id' => $row['train_id'],
                    'name' => $row['train_name'],
                    'repairs' => []
                ];
            }

            if ($row['repair_id']) {
                $trains[$trainId]['repairs'][] = [
                    'id' => $row['repair_id'],
                    'type' => $row['repair_type'],
                    'date' => $row['repair_date']
                ];
            }
        }

        return array_values($trains); // Réindexer le tableau pour avoir un JSON propre
    }
}
