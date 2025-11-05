<?php

// Sobe um nível (de Controller/) para a raiz (Reintegra/) e entra no Model/
require_once __DIR__ . '/../Model/Cursos_model.php';

class CursosController {
    
    private $model;

    public function __construct() {
        $this->model = new CursosModel();
    }

    /**
     * Gerenciador de requisições do Admin (View/Criar_cursos.php)
     * Decide qual ação (Criar, Atualizar, Excluir) deve ser executada.
     */
    public function handleAdminRequest() {
        $acao = $_GET['action'] ?? 'listar'; // Ação padrão
        $dados_retorno = [];

        try {
            // --- AÇÕES DE ESCRITA (via POST) ---
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                // Ação de CRIAR
                if ($_POST['action'] == 'criar') {
                    $this->model->createCurso(
                        $_POST['titulo'],
                        $_POST['link_externo'],
                        $_POST['descricao']
                    );
                    // Redireciona para a própria página com msg de sucesso
                    header('Location: Criar_cursos.php?sucesso=criado');
                    exit;
                }
                
                // Ação de ATUALIZAR
                if ($_POST['action'] == 'atualizar') {
                    $this->model->updateCurso(
                        $_POST['course_id'],
                        $_POST['titulo'],
                        $_POST['link_externo'],
                        $_POST['descricao']
                    );
                    header('Location: Criar_cursos.php?sucesso=atualizado');
                    exit;
                }
            }
            
            // --- AÇÕES DE LEITURA/EXCLUSÃO (via GET) ---

            // Ação de EXCLUIR
            if ($acao == 'excluir' && isset($_GET['id'])) {
                $this->model->deleteCurso($_GET['id']);
                header('Location: Criar_cursos.php?sucesso=excluido');
                exit;
            }
            
            // Ação de EDITAR (prepara dados para o formulário)
            if ($acao == 'editar' && isset($_GET['id'])) {
                $dados_retorno['acao'] = 'editar';
                $dados_retorno['curso'] = $this->model->getCursoById($_GET['id']);
            } else {
                $dados_retorno['acao'] = 'criar'; // Padrão é mostrar form de criação
            }

        } catch (Exception $e) {
            $dados_retorno['erro'] = 'Ocorreu um erro: ' . $e->getMessage();
        }
        
        // Sempre retorna os dados para a View
        return $dados_retorno;
    }
    
    /**
     * Método para a PÁGINA PÚBLICA (View/Cursos.php)
     * Apenas lista todos os cursos.
     */
    public function getCursosPublico() {
        try {
            return $this->model->getAllCursos();
        } catch (Exception $e) {
            // Em caso de erro, retorna um array vazio
            return [];
        }
    }
}
?>