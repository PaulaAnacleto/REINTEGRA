<?php
// Inclui o arquivo de configuração uma única vez
require_once __DIR__ . '/../Config/configuration.php';

class Connection {
    
    // Guarda a instância da conexão (padrão Singleton)
    private static $pdo;

    // Método estático: você chama Connection::getDb() em vez de new Connection()
    public static function getDb() {
        
        // Se a conexão ainda não foi criada, crie-a
        if (self::$pdo === null) {
            try {
                // Monta a string de conexão (DSN)
                $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
                
                // Cria a conexão PDO
                self::$pdo = new PDO($dsn, DB_USER, DB_PASS);
                
                // Define o modo de erro para lançar exceções
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                // Se falhar, encerra a aplicação
                die('Erro de conexão com o banco de dados: ' . $e->getMessage());
            }
        }
        
        // Retorna a conexão existente
        return self::$pdo;
    }
}
?>