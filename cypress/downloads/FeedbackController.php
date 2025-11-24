<?php
// Controller/FeedbackController.php
session_start(); 
require_once __DIR__ . '/../Model/FeedbackModel.php';

if (!isset($_SESSION['id_usuario'])) {
    
    header("Location: ../View/login.php?status=erro_login"); // Ajuste o caminho se necessário
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

   
    $mensagem = isset($_POST['feedback_mensagem']) ? htmlspecialchars(trim($_POST['feedback_mensagem'])) : '';
  
    $id_usuario = $_SESSION['id_usuario']; 

    
    if (empty($mensagem)) {

        header("Location: ../View/Inicial-login.php?status=erro_vazio#cadastro");
        exit;
    }

  
    $feedbackModel = new FeedbackModel();
 
    $sucesso = $feedbackModel->save($mensagem, $id_usuario);


    if ($sucesso) {
       
        header("Location: ../View/Inicial-login.php?status=sucesso#cadastro");
    } else {

        header("Location: ../View/Inicial-login.php?status=erro_db#cadastro");
    }
    exit;

} else {
   
    header("Location: ../View/Inicial-login.php");
    exit;
}
?>