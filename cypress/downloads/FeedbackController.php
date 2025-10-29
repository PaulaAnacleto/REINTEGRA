<?php
// Controller/FeedbackController.php
session_start(); // Sempre inicie a sessão no Controller

// Inclui o Model que acabamos de criar
require_once __DIR__ . '/../Model/FeedbackModel.php';

// 1. VERIFICAR AUTENTICAÇÃO
// (Estou assumindo que você guarda o ID do usuário na sessão após o login)
if (!isset($_SESSION['id_usuario'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: ../View/login.php?status=erro_login"); // Ajuste o caminho se necessário
    exit;
}

// 2. VERIFICAR MÉTODO DA REQUISIÇÃO
// O código só deve rodar se o formulário for enviado (método POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 3. PEGAR E VALIDAR OS DADOS
    // Pega a mensagem do formulário
    $mensagem = isset($_POST['feedback_mensagem']) ? htmlspecialchars(trim($_POST['feedback_mensagem'])) : '';
    // Pega o ID do usuário da sessão
    $id_usuario = $_SESSION['id_usuario']; 

    // Validação simples: a mensagem não pode estar vazia
    if (empty($mensagem)) {
        // Redireciona de volta para a página com um erro
        header("Location: ../View/Inicial-login.php?status=erro_vazio#cadastro");
        exit;
    }

    // 4. USAR O MODEL PARA SALVAR
    // Cria um novo objeto do tipo FeedbackModel
    $feedbackModel = new FeedbackModel();
    
    // Tenta salvar os dados no banco
    $sucesso = $feedbackModel->save($mensagem, $id_usuario);

    // 5. REDIRECIONAR O USUÁRIO
    if ($sucesso) {
        // Deu certo! Redireciona com status de sucesso
        header("Location: ../View/Inicial-login.php?status=sucesso#cadastro");
    } else {
        // Deu erro no banco. Redireciona com status de erro
        header("Location: ../View/Inicial-login.php?status=erro_db#cadastro");
    }
    exit;

} else {
    // Se alguém tentar acessar este arquivo direto pela URL (GET),
    // apenas redireciona para a página inicial.
    header("Location: ../View/Inicial-login.php");
    exit;
}
?>