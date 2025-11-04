<?php
require_once '../Model/TesteVocacionalModel.php'; 

$model = new TesteVocacionalModel();

if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    
    $perguntas = $model->getPerguntas();
    $areas = $model->getAreas();
    
    echo json_encode([
        'perguntas' => $perguntas,
        'areas' => $areas
    ]);
    exit;
}

if (isset($_GET['ia'])) {
    header('Content-Type: application/json');
    
    $area_principal = $_GET['area'] ?? 'tecnologia';
    $pontuacao = $_GET['score'] ?? 0; 
    
    $dica = $model->getDica($area_principal, $pontuacao); 
    
    echo json_encode([
        'sucesso' => true,
        'dica' => $dica,
        'area' => $area_principal
    ]);
    exit;
}
?>