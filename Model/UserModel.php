<?php
require_once 'Connection.php';

class UserModel {
    
    private $conn;

    public function __construct() {
        $this->conn = Connection::getDb();
    }

    /**
     * Busca um usuário pelo seu ID.
     * Retorna um array associativo com os dados ou false se não encontrar.
     */
    public function findById($id) {
        try {
            // Estou assumindo que sua tabela se chama 'usuarios'
            $sql = "SELECT * FROM usuarios WHERE id = :id LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            // Retorna os dados do usuário
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Busca um usuário pelo email (útil para ver se já existe).
     * Retorna dados do usuário ou false.
     */
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

    /**
     * Atualiza os dados de um usuário no banco.
     * $data é um array associativo (ex: ['nomeCompleto' => 'Novo Nome', ...])
     */
    public function update($id, $data) {
        try {
            // Os nomes das colunas devem ser iguais aos 'name' do seu formulário
            $sql = "UPDATE usuarios SET 
                        nomeCompleto = :nomeCompleto,
                        email = :email,
                        dataNascimento = :dataNascimento,
                        cpf = :cpf,
                        profissao = :profissao
                    WHERE id = :id";
            
            $stmt = $this->conn->prepare($sql);
            
            // Binda (associa) os valores do array $data e o $id
            $stmt->bindParam(':nomeCompleto', $data['nomeCompleto']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':dataNascimento', $data['dataNascimento']);
            $stmt->bindParam(':cpf', $data['cpf']);
            $stmt->bindParam(':profissao', $data['profissao']);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            // Executa e retorna true se deu certo
            return $stmt->execute();

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    // ... (provavelmente você tem aqui seus métodos de login, registrar, etc.)
}
?>