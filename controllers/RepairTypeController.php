<?php
require_once 'models/Repair.php';

class RepairTypeController
{
    public static function index()
    {
        echo json_encode(Repair::getAllRepairTypes());
    }
}
