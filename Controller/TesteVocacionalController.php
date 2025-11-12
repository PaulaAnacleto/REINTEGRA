<?php
// Em REINTEGRA/Controller/TesteVocacionalController.php

// 1. Inclui o "Cofre"
require_once '../Model/TesteVocacionalModel.php'; 

// 2. Cria uma instância do "Cofre"
$model = new TesteVocacionalModel();

// 3. Verifica o que o JavaScript está pedindo

// --- Rota para buscar as perguntas e áreas ---
if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    
    // Pede os dados ao "Cofre"
    $perguntas = $model->getPerguntas();
    $areas = $model->getAreas();
    
    // Envia a resposta
    echo json_encode([
        'perguntas' => $perguntas,
        'areas' => $areas
    ]);
    exit;
}

// --- Rota para buscar a dica de IA ---
if (isset($_GET['ia'])) {
    header('Content-Type: application/json');
    
    $area_principal = $_GET['area'] ?? 'tecnologia';
    // Pega a pontuação enviada pelo JavaScript
    $pontuacao = $_GET['score'] ?? 0; 
    
    // Pede a dica ao "Cofre", AGORA PASSANDO A PONTUAÇÃO
    $dica = $model->getDica($area_principal, $pontuacao); 
    
    // Envia a resposta
    echo json_encode([
        'sucesso' => true,
        'dica' => $dica,
        'area' => $area_principal
    ]);
    exit;
}
?>
