<?php
// Inclui o arquivo que sabe como se conectar
require_once 'Connection.php';

class FeedbackModel {
    
    private $conn;

    // O 'constructor' é chamado automaticamente quando você cria o objeto
    public function __construct() {
        // Pega a conexão do 'Connection.php' e guarda em $this->conn
        $this->conn = Connection::getDb();
    }

    /**
     * Salva um novo feedback no banco de dados.
     * @param string $mensagem O texto do feedback.
     * @param int $id_usuario O ID do usuário que está enviando.
     * @return bool Retorna true se salvou com sucesso, false se deu erro.
     */
    public function save($mensagem, $id_usuario) {
        try {
            $sql = "INSERT INTO feedbacks (mensagem, id_usuario) VALUES (:mensagem, :id_usuario)";
            
            // Prepara a consulta
            $stmt = $this->conn->prepare($sql);
            
            // Associa os valores para evitar SQL Injection
            $stmt->bindParam(':mensagem', $mensagem);
            $stmt->bindParam(':id_usuario', $id_usuario);
            
            // Executa
            $stmt->execute();
            
            // Se chegou aqui, deu certo
            return true;

        } catch (PDOException $e) {
            // Se deu erro, registra em um log (boa prática)
            error_log($e->getMessage());
            // Retorna falso para o Controller saber que falhou
            return false;
        }
    }
}
?>