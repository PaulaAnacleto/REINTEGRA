<?php
require_once 'Connection.php';

class UserModel {
    
    private $conn;

    public function __construct() {
        $this->conn = Connection::getDb();
    }


    public function register($nome, $email, $senhaHash) {
        try {
            $sql = "INSERT INTO usuarios (nomeCompleto, email, senha) 
                    VALUES (:nome, :email, :senha)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senhaHash);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

  
    public function findByEmail($email) {
        try {
            $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

 
    public function findById($id) {
        try {
            $sql = "SELECT * FROM usuarios WHERE id = :id LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

  
    public function update($id, $data) {
        try {
            $sql = "UPDATE usuarios SET 
                        nomeCompleto = :nomeCompleto,
                        email = :email,
                        dataNascimento = :dataNascimento,
                        cpf = :cpf,
                        profissao = :profissao
                    WHERE id = :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nomeCompleto', $data['nomeCompleto']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':dataNascimento', $data['dataNascimento']);
            $stmt->bindParam(':cpf', $data['cpf']);
            $stmt->bindParam(':profissao', $data['profissao']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>