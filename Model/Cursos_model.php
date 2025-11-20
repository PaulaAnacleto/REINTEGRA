<?php

// Usa a nova conexão específica de cursos
require_once 'Conexao_cursos.php';

class CursosModel {
    
    private $pdo;

    public function __construct() {
        // Pega a conexão do novo arquivo
        $this->pdo = ConexaoCursos::getConnection();
    }

    /**
     * CREATE: Insere um novo curso no banco
     */
    public function createCurso($titulo, $links, $descricao) {
        // Usa os nomes das colunas do seu Workbench: Titulo, Links, Descricao_cur
        $sql = "INSERT INTO curso (Titulo, Links, Descricao_cur) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$titulo, $links, $descricao]);
    }

    /**
     * READ: Busca todos os cursos
     */
    public function getAllCursos() {
        $sql = "SELECT * FROM curso ORDER BY Titulo";
        $stmt = $this->pdo->query($sql);
        // Retorna todos como um array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * READ: Busca um único curso pelo seu ID
     */
    public function getCursoById($id) {
        // Usa a Primary Key 'idcurso'
        $sql = "SELECT * FROM curso WHERE idcurso = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        // Retorna apenas um
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * UPDATE: Atualiza um curso existente
     */
    public function updateCurso($id, $titulo, $links, $descricao) {
        $sql = "UPDATE curso SET Titulo = ?, Links = ?, Descricao_cur = ? WHERE idcurso = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$titulo, $links, $descricao, $id]);
    }

    /**
     * DELETE: Exclui um curso do banco
     */
    public function deleteCurso($id) {
        $sql = "DELETE FROM curso WHERE idcurso = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>