<?php
session_start();
require_once __DIR__ . '/../Model/FeedbackModel.php';

// Define o tipo de resposta como JSON
header('Content-Type: application/json');

// 1. Verificação de Segurança (Usuário está logado?)
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode([
        'success' => false, 
        'message' => 'Você precisa estar logado para enviar um feedback.'
    ]);
    exit;
}

// 2. Verifica se o método é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 3. Pega e valida os dados
    $mensagem = trim($_POST['feedback_mensagem'] ?? '');
    $id_usuario = $_SESSION['id_usuario'];

    if (empty($mensagem)) {
        echo json_encode([
            'success' => false, 
            'message' => 'Por favor, escreva uma mensagem antes de enviar.'
        ]);
        exit;
    }

    // 4. Tenta salvar no banco
    $feedbackModel = new FeedbackModel();
    $sucesso = $feedbackModel->save($mensagem, $id_usuario);

    // 5. Envia a resposta JSON
    if ($sucesso) {
        echo json_encode([
            'success' => true, 
            'message' => 'Feedback enviado com sucesso! Obrigado.'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Erro ao salvar o feedback. Tente novamente.'
        ]);
    }

} else {
    // Se não for POST, retorna erro
    echo json_encode([
        'success' => false, 
        'message' => 'Método não permitido.'
    ]);
}
?>