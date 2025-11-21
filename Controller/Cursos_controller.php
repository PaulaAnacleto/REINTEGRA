<?php

require_once __DIR__ . '/../Model/Cursos_model.php';

class CursosController {
    
    private $model;

    public function __construct() {
        $this->model = new CursosModel();
    }

    public function handleAdminRequest() {
        $acao = $_GET['action'] ?? 'listar';
        $dados_retorno = [];

        try {

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                

                if ($_POST['action'] == 'criar') {
                    $this->model->createCurso(
                        $_POST['titulo'],
                        $_POST['link_externo'],
                        $_POST['descricao']
                    );

                    header('Location: Criar_cursos.php?sucesso=criado');
                    exit;
                }

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
            
            if ($acao == 'excluir' && isset($_GET['id'])) {
                $this->model->deleteCurso($_GET['id']);
                header('Location: Criar_cursos.php?sucesso=excluido');
                exit;
            }

            if ($acao == 'editar' && isset($_GET['id'])) {
                $dados_retorno['acao'] = 'editar';
                $dados_retorno['curso'] = $this->model->getCursoById($_GET['id']);
            } else {
                $dados_retorno['acao'] = 'criar'; 
            }

        } catch (Exception $e) {
            $dados_retorno['erro'] = 'Ocorreu um erro: ' . $e->getMessage();
        }
        

        return $dados_retorno;
    }

    public function getCursosPublico() {
        try {
            return $this->model->getAllCursos();
        } catch (Exception $e) {
            return [];
        }
    }
}
?>