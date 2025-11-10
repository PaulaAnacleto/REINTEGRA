<?php

namespace Model;

use PDO;
use PDOException;

class User
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Verifica se um email já existe no banco de dados.
     */
    public function emailExists(string $email): bool
    {
        $stmt = $this->pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch() !== false;
    }

    /**
     * Salva um novo usuário no banco de dados.
     * Retorna o ID do usuário inserido ou false em caso de falha.
     */
    public function save(string $nomeCompleto, string $email, string $senha): int|false
    {
        // Criptografa a senha antes de salvar
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

        $sql = "INSERT INTO usuarios (nomeCompleto, email, senha) VALUES (:nome, :email, :senha)";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nome' => $nomeCompleto,
                ':email' => $email,
                ':senha' => $senhaHash
            ]);
            return (int)$this->pdo->lastInsertId();
        } catch (PDOException $e) {
            // Em um projeto real, você poderia logar o erro.
            // error_log($e->getMessage());
            return false;
        }
    }
}
