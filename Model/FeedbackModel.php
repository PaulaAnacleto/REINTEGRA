<?php
require_once 'Connection.php';

class FeedbackModel {
    
    private $conn;

    public function __construct() {
        // Pega a conexão do 'Connection.php'
        // CORRIGIDO: Connection::getDb()
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
            $sql = "INSERT INTO feedbacks (mensagem, id_usuario) 
                    VALUES (:mensagem, :id_usuario)";
            
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindParam(':mensagem', $mensagem);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            
            return $stmt->execute();

        } catch (PDOException $e) {
            error_log($e->getMessage()); 
            return false;
        }
    }
}
?>