<?php
session_start();
require_once __DIR__ . '/../Model/FeedbackModel.php';

header('Content-Type: application/json');


if (!isset($_SESSION['id_usuario'])) {
    echo json_encode([
        'success' => false, 
        'message' => 'Você precisa estar logado para enviar um feedback.'
    ]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
    $mensagem = trim($_POST['feedback_mensagem'] ?? '');
    $id_usuario = $_SESSION['id_usuario'];

    if (empty($mensagem)) {
        echo json_encode([
            'success' => false, 
            'message' => 'Por favor, escreva uma mensagem antes de enviar.'
        ]);
        exit;
    }

    $feedbackModel = new FeedbackModel();
    $sucesso = $feedbackModel->save($mensagem, $id_usuario);

    
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

    echo json_encode([
        'success' => false, 
        'message' => 'Método não permitido.'
    ]);
}
?>