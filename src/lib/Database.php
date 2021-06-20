<?php

namespace src\lib;

use PDO;

class Database
{
    public static ?Database $instance = null;
    private PDO $db;
    public function __construct()
    {
        $connection = $_ENV['DB_CONNECTION'];
        $host = $_ENV['DB_HOST'];
        $database = $_ENV['DB_DATABASE'];
        $user = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->db = new PDO(
            'mysql:host=' .
            $host .
            ';dbname=' .
            $database,
            $user,
            $password,
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
