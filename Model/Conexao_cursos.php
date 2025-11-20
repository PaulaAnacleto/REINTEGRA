<?php

class ConexaoCursos {
    private static $host = 'localhost';      // Ou 127.0.0.1
    private static $dbname = 'cursos';       // Seu schema (vi na imagem)
    private static $user = 'root';           // Usuário padrão do XAMPP/MySQL
    private static $pass = '';              // Senha padrão (vazia)
    private static $port = 3306;             // Porta Padrão do MySQL

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