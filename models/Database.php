<?php
class Database
{
    private static $pdo;

    public static function connect()
    {
        if (!self::$pdo) {
            $dsn = 'pgsql:host=dpg-cu9pj9dumphs73cff3b0-a.frankfurt-postgres.render.com;'
                . 'port=5432;'
                . 'dbname=train_1rb9;'
                . 'sslmode=require';

            try {
                self::$pdo = new PDO(
                    $dsn,
                    'train_1rb9_user',
                    'hCsnwV6f7q3tix8hNKSRiUoYNmyDOxk9',
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $e) {
                // Log l'erreur pour le debugging
                error_log("Erreur de connexion à la base de données : " . $e->getMessage());
                throw $e;
            }
        }
        return self::$pdo;
    }
}
