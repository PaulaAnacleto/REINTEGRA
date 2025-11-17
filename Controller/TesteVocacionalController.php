<?php
// 1. O ÚNICO arquivo que você precisa é o Model
require_once '../Model/TesteVocacionalModel.php';

// 2. Instancie o Model
$model = new TesteVocacionalModel();

// Rota para buscar os dados do teste (Perguntas e Áreas)
if (isset($_GET['ajax'])) {
  header('Content-Type: application/json');
  echo json_encode([
    'perguntas' => $model->getPerguntas(),
    'areas' => $model->getAreas()
  ]);
  exit;
}

// Rota para buscar a Dica da IA
if (isset($_GET['ia'])) {
  header('Content-Type: application/json');

  $area = $_GET['area'] ?? 'tecnologia';
  $score = (int)($_GET['score'] ?? 0); // Converte para inteiro

  // 3. CHAME O MÉTODO CORRETO (DO MODEL)
  // Esta função getDica() já tem o fallback, já tem o cURL... tem tudo.
  $dicaGerada = $model->getDica($area, $score);

  echo json_encode([
    'sucesso' => true,
    'dica' => $dicaGerada, // Envia a dica (seja da IA ou o fallback)
    'area' => $area
  ]);
  exit;
}

// Se nenhuma rota for encontrada, apenas saia
exit;
?>

