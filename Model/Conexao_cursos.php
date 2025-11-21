<?php

class ConexaoCursos {
    private static $host = 'localhost';      
    private static $dbname = 'cursos';    
    private static $user = 'root';          
    private static $pass = '';              
    private static $port = 3306;           

    private static $pdo = null;

    public static function getConnection() {
        if (self::$pdo == null) {
            try {
                self::$pdo = new PDO(
                    "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname,
                    self::$user,
                    self::$pass
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->exec("SET NAMES 'utf8mb4'"); // Suporte a UTF-8
            } catch (PDOException $e) {
                die("Erro ao conectar com o banco de dados [cursos]: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>