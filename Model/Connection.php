<?php

require_once __DIR__ . '/../Config/configuration.php';
class Connection {
    
    private static $pdo; // Guarda a instância da conexão

    public static function getDb() {
        if (self::$pdo === null) {
            try {
                $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
                self::$pdo = new PDO($dsn, DB_USER, DB_PASS);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erro de conexão com o banco de dados: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}