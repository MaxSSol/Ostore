<?php

namespace src\lib;

use PDO;

class Database
{
    public static ?Database $instance = null;
    private PDO $db;
    public function __construct()
    {
        $config = require_once __DIR__ . '/../config/configDb.php';
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->db = new PDO(
            'mysql:host=' .
            $config['host'] .
            ';dbname=' .
            $config['dbname'],
            $config['user'],
            $config['password'],
            $opt
        );
    }
    public function query(string $sql, array $params = []): ?array
    {
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute($params);
        if ($result === false) {
            return null;
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
