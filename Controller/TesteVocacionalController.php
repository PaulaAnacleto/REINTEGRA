<?php
require_once '../Model/TesteVocacionalModel.php';
require_once '../Config/geminiConfig.php';

$model = new TesteVocacionalModel();

if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    echo json_encode([
        'perguntas' => $model->getPerguntas(),
        'areas' => $model->getAreas()
    ]);
    exit;
}

if (isset($_GET['ia'])) {
    header('Content-Type: application/json');

    $area = $_GET['area'] ?? 'tecnologia';
    $score = $_GET['score'] ?? 0;

    // Prompt para IA
    $prompt = "Sou um estudante que se destacou na área de {$area} com pontuação {$score}. 
    Gere uma dica motivacional personalizada sobre como essa área pode se tornar uma carreira de sucesso, 
    em até 100 palavras.";

    $respostaIA = gerarDicaIA($prompt);

    echo json_encode([
        'sucesso' => true,
        'dica' => $respostaIA,
        'area' => $area
    ]);
    exit;
}
?>

